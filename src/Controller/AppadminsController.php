<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\Log\Log;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Mailer;
use Cake\Mailer\Email;
use Cake\Filesystem\File;
use Laminas\Diactoros\UploadedFile;


class AppadminsController extends AppController
{
    protected $Users;
    protected $UserDetails;
    protected $Schools;

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Custom');

        // Load the necessary tables
        $this->Users = $this->fetchTable('Users');
        $this->UserDetails = $this->fetchTable('UserDetails');
        $this->Schools = $this->fetchTable('SchoolDetails');
        $this->Registrations = $this->fetchTable('RegistrationDetails');
        $this->Settings = $this->fetchTable('SettingDetails');
        $this->Optionals = $this->fetchTable('OptionalDetails');
        $this->PaypalDetails = $this->fetchTable('PaypalDetails');
        
        // Load Flash component
        $this->loadComponent('Flash');
        $this->viewBuilder()->setLayout('admin');
    }

    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login', 'register']);
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('admin_login');
        $title = "Login";

        // Check if the user is already logged in (by session)
        $user = $this->Authentication->getIdentity();
        if ($user) {
            return $this->redirect(['controller' => 'Appadmins', 'action' => 'index']);
        }

        // If the form was submitted (POST request)
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $result = $this->Authentication->getResult();

            if ($result->isValid()) {
                $user = $result->getData();

                // Check the user type (you can adjust this based on your app's logic)
                if (!in_array($user['type'], [1, 2])) {
                    $this->Flash->warning(__('Can\'t access. Contact with admin.'));
                    return $this->redirect(['controller' => 'Appadmins', 'action' => 'login']);
                }

                // Set the user in the session (done automatically by the Authentication plugin)
                $this->Authentication->setIdentity($user);

                // Flash message for successful login
                $this->Flash->success(__('Welcome ' . $user['name']));

                // Optional: Update the last login info
                $this->Users->updateAll(
                    ['last_login_date' => date('Y-m-d H:i:s'), 'last_login_ip' => $this->request->clientIp()],
                    ['id' => $user['id']]
                );

                // Check for a redirect URL, otherwise redirect to the dashboard
                $redirectUrl = $this->request->getQuery('redirect');
                if ($redirectUrl) {
                    return $this->redirect($redirectUrl);
                }

                // Redirect to dashboard after successful login
                return $this->redirect(['controller' => 'Appadmins', 'action' => 'index']);
            }

            // If authentication fails
            $this->Flash->warning(__('Email or password is incorrect'));
        }

        // Set title for the view
        $this->set(compact('title'));
    }
    public function index() {
        return $this->redirect(['controller' => 'Appadmins', 'action' => 'dashboard']);
        exit;
    }
    public function dashboard() {
        $all_data = [];
         $this->set(compact('all_data'));
     }
    public function logout()
    {
        // Log the logout event
        Log::debug('User logged out.');

        // Logout the user
        $this->Authentication->logout();
        $this->Flash->success(__('You have been logged out.'));

        return $this->redirect(['action' => 'login']);
    }


    public function forgotPassword() {
        if ($this->getRequest()->getSession()->read('Authentication.User.id') != '') {
            return $this->redirect(['controller' => 'Appadmins', 'action' => 'index']);
        }
        $this->viewBuilder()->setLayout('admin_login');
        $title = "Forgot Password";
        $this->set(compact('title'));
    }

    public function recoverPassword($toke = null) {
        if ($this->getRequest()->getSession()->read('Auth.User.id') != '') {
            return $this->redirect(['controller' => 'Appadmins', 'action' => 'index']);
        }
        $this->viewBuilder()->setLayout('admin_login');
        $title = "Recover Password";


        if (empty($toke)) {
            $this->Flash->error(__('ERROR. Try again...'));
            return $this->redirect(HTTP_ROOT . 'admin-login');
        }
        $user_data = $this->Users->find('all')->where(['token' => $toke])->first();
        if (empty($user_data)) {
            $this->Flash->error(__('ERROR. Try again...'));
            return $this->redirect(HTTP_ROOT . 'admin-login');
        }
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            if (!empty($postData['password'])) {
                $hasher = new DefaultPasswordHasher();
                $password = $hasher->hash($postData['password']);
                $this->Users->updateAll(['password' => $password, 'token' => ''], ['id' => $user_data->id]);
            }
            $this->Flash->success(__('Password changed successfuly.'));
            return $this->redirect(HTTP_ROOT . 'admin-login');
        }


        $this->set(compact('title'));
    }

    public function siteSetting() {
        $site_name = $this->Optionals->find('all')->where(['name' => 'site_name'])->first();
        $site_short_name = $this->Optionals->find('all')->where(['name' => 'site_short_name'])->first();

        $this->set(compact('site_name', 'site_short_name'));
        
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            if (!empty($postData['logo']['tmp_name'])) {
                $imagePath = "img/";
                $ext = explode('.', $postData["logo"]["name"]);
                if (strtolower(end($ext)) != 'png') {
                    $this->Flash->error(__('Only Png file allowerd.'));
                    return $this->redirect(['action' => 'siteSetting']);
                }
                $custom_name = 'logo.' . end($ext);

                $filename = $postData["logo"]["tmp_name"];
                list($width, $height) = getimagesize($filename);

                if (move_uploaded_file($filename, $imagePath . $custom_name)) {
                    $this->Flash->success(__('Logo has been updated.'));
                    return $this->redirect(['action' => 'siteSetting']);
                }
                $this->Flash->error(__('Data could not be saved. Please, try again.'));
            }
            if (!empty($postData['icon']['tmp_name'])) {
                $imagePath = "img/";
                $ext = explode('.', $postData["icon"]["name"]);
                if (strtolower(end($ext)) != 'png') {
                    $this->Flash->error(__('Only Png file allowerd.'));
                    return $this->redirect(['action' => 'siteSetting']);
                }
                $custom_name = 'Favicon.' . end($ext);

                $filename = $postData["icon"]["tmp_name"];
                list($width, $height) = getimagesize($filename);

                if (move_uploaded_file($filename, $imagePath . $custom_name)) {
                    $this->Flash->success(__('Site icon has been updated.'));
                    return $this->redirect(['action' => 'siteSetting']);
                }
                $this->Flash->error(__('Data could not be saved. Please, try again.'));
            }

            if (!empty($postData['site_name']) || !empty($postData['site_short_name'])) {

                $new_site_name = [];
                if (!empty($site_name)) {
                    $new_site_name['id'] = $site_name->id;
                }
                $new_site_name['name'] = 'site_name';
                $new_site_name['value'] = $postData['site_name'];

                $siteName = $this->Optionals->newEntity();
                $siteName = $this->Optionals->patchEntity($siteName, $new_site_name);
                $this->Optionals->save($siteName);


                $new_site_short_name = [];
                if (!empty($site_short_name)) {
                    $new_site_short_name['id'] = $site_short_name->id;
                }
                $new_site_short_name['name'] = 'site_short_name';
                $new_site_short_name['value'] = $postData['site_short_name'];

                $siteShortName = $this->Optionals->newEntity();
                $siteShortName = $this->Optionals->patchEntity($siteShortName, $new_site_short_name);
                $this->Optionals->save($siteShortName);

                $this->Flash->success(__('Data has been updated.'));
                return $this->redirect(['action' => 'siteSetting']);
            }
        }
    }

    public function accountSetting() {
        // $this->loadModel('PaypalDetails');
        
        $admin_mail = $this->Settings->find('all')->where(['type' => 1, 'name' => 'ADMIN_TO_MAIL'])->first();
        $from_mail = $this->Settings->find('all')->where(['type' => 1, 'name' => 'FROM_EMAIL'])->first();

        $this->Users->hasOne('UserDetails', ['className' => 'UserDetails', 'foreignKey' => 'user_id'/* , 'conditions' => ['UserDetails.user_id' => $this->Auth->User('id)] */]);
        // $userData = $this->Users->find('all')->contain(['UserDetails'])->where(['Users.id' => $this->Authentication->user('id')])->first();
        $userData = $this->Users
    ->find()
    ->contain(['UserDetails'])
    ->where(['Users.id' => $this->request->getAttribute('identity')->get('id')])
    ->first();

        $paypal_details = $this->PaypalDetails->find('all')->first();
        
        
//        pj($userData);exit;
        $this->set(compact('admin_mail', 'from_mail', 'userData','paypal_details'));
    }

    public function accountUpdate() {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['post']);
        $postData = $this->request->getData();

        $path = WWW_ROOT . 'files' . DS . 'admin_photos';
        $folder = new Folder($path);
        if (is_null($folder->path)) {
            $folder->create($path);
            new Folder($path, true, 0755);
        }

        $this->Users->hasOne('UserDetails', ['className' => 'UserDetails', 'foreignKey' => 'user_id']);
        $userData = $this->Users->find('all')->contain(['UserDetails'])->where(['Users.id' => $this->Auth->user('id')])->first();

        if (!empty($postData['email'])) {
            if ($postData['email'] != $userData->email) {
                $checkMail = $this->Users->find('all')->where(['email' => $postData['email']])->count();
                if ($checkMail != 0) {
                    $this->Flash->error(__('Email address already present.'));
                    return $this->redirect(['action' => 'accountSetting']);
                }
                $this->Users->updateAll(['email' => $postData['email']], ['id' => $this->Auth->User('id')]);
            }
        }

        $this->Users->updateAll(['name' => $postData['name']], ['id' => $this->Auth->User('id')]);

        $new_user_details_data = [];
        if (!is_null($userData->user_detail) && !empty($userData->user_detail->id)) {
            $new_user_details_data['id'] = $userData->user_detail->id;
        }

        $new_user_details_data['user_id'] = $this->Auth->User('id');
        $new_user_details_data['phone_number'] = $postData['phone_number'];
        $new_user_details_data['gender'] = $postData['gender'];
        $new_user_details_data['address'] = $postData['address'];

        if (!empty($postData['file_input']['tmp_name'])) {
            if (!empty($userData->user_detail->photo)) {
                @unlink($userData->user_detail->path . $userData->user_detail->photo);
            }

            $imagePath = "img/";
            $ext = explode('.', $postData["file_input"]["name"]);
            $custom_name = time() . rand() . '.' . end($ext);

            $filename = $postData["file_input"]["tmp_name"];
            list($width, $height) = getimagesize($filename);
            move_uploaded_file($filename, $imagePath . $custom_name);
            $new_user_details_data['path'] = $imagePath;
            $new_user_details_data['photo'] = $custom_name;
        }

        $newEntity = $this->UserDetails->newEntity();
        $newEntity = $this->UserDetails->patchEntity($newEntity, $new_user_details_data);
        $this->UserDetails->save($newEntity);

        $this->Flash->success(__('Data has been updated successfuly.'));
        return $this->redirect(['action' => 'accountSetting']);
        exit;
    }

    public function mailUpdate() {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['post']);
        $postData = $this->request->getData();

        if (!empty($postData['admin_mail'])) {
            $this->Settings->updateAll(['value' => $postData['admin_mail']], ['type' => 1, 'name' => 'ADMIN_TO_MAIL']);
        }
        if (!empty($postData['from_mail'])) {
            $this->Settings->updateAll(['value' => $postData['from_mail']], ['type' => 1, 'name' => 'FROM_EMAIL']);
        }

        $this->Flash->success(__('Data has been updated successfuly.'));
        return $this->redirect(['action' => 'accountSetting']);
        exit;
    }

    public function changePassword() {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['post']);
        $postData = $this->request->getData();
        if (!empty($postData['password'])) {
            $hasher = new DefaultPasswordHasher();
            $password = $hasher->hash($postData['password']);
            $this->Users->updateAll(['password' => $password], ['id' => $this->Auth->User('id')]);
        }
        $this->Flash->success(__('Password has been updated successfuly.'));
        return $this->redirect(['action' => 'accountSetting']);
        exit;
    }

    public function emailTemplate($option = null, $id = null) {
        $allData = $this->Settings->find('all')->where(['type' => 2]);
        $getData = [];

        if (!empty($id)) {
            $getData = $this->Settings->find('all')->where(['id' => $id, 'type' => 2])->first();
            if (empty($getData)) {
                $this->Flash->error(__('No data found. Please, try again.'));
                return $this->redirect(['action' => 'emailTemplate']);
            }
        }
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if (empty($getData->id)) {
                $this->Flash->error(__('Data could not be saved. Please, try again.'));
                return $this->redirect(['action' => 'emailTemplate']);
            }

            if (empty($data['value'])) {
                $this->Flash->error(__('Content can\'t be empty. Add content..'));
                return $this->redirect(['action' => 'emailTemplate', 'edit', @$getData->id]);
            }

            $newData = $this->Settings->newEntity();
            $data['id'] = @$getData->id;
            $newData = $this->Settings->patchEntity($newData, $data);

            if ($this->Settings->save($newData)) {
                $this->Flash->success(__('Data has been updated.'));
                return $this->redirect(['action' => 'emailTemplate']);
            }

            $this->Flash->error(__('Data could not be saved. Please, try again.'));
        }

        $this->set(compact('id', 'allData', 'getData'));
    }







    public function schoolRegistration($option = null, $id = null)
    {
        $allData = $this->Schools->find('all')->all(); // Use ->all() to fetch results
        $getData = null;

        // Handle actions with the $option and $id
        if (!empty($option) && !empty($id)) {
            // try {
            //     $getData = $this->Schools->get($id); // Use get() to fetch a single record by ID
            // } catch (RecordNotFoundException $e) {
            //     $this->Flash->error(__('School record not found.'));
            //     return $this->redirect(['action' => 'schoolRegistration']);
            // }
            $getData = $this->Schools->find('all')->where(['id' => $id])->first();
            if ($option === "delete") {
                $this->Schools->delete($getData);
                $this->Flash->success(__('Data deleted successfully.'));
                return $this->redirect(['action' => 'schoolRegistration']);
            }

            if ($option === "active") {
                $getData->is_active = 1;
                $this->Schools->save($getData);
                $this->Flash->success(__('Data has been activated.'));
                return $this->redirect(['action' => 'schoolRegistration']);
            }

            if ($option === "deactive") {
                $getData->is_active = 2;
                $this->Schools->save($getData);
                $this->Flash->success(__('Data has been deactivated.'));
                return $this->redirect(['action' => 'schoolRegistration']);
            }
        }

        // Handle POST requests
        if ($this->request->is('post')) {
            $postData = $this->request->getData();

            // If editing, load the existing entity
            $entity = !empty($getData) ? $getData : $this->Schools->newEmptyEntity();

            // Patch data into the entity
            $entity = $this->Schools->patchEntity($entity, $postData);

            if ($this->Schools->save($entity)) {
                // Prepare email after saving
                $schoolName = $postData['school_name'];
                $schoolBranch = $postData['branch_name'];
                $schoolAddress = $postData['address'];
                $date = date("F d, Y");

                $emailMessage = $this->Settings->find()
                    ->where(['name' => 'CONTACT_US'])
                    ->first();

                $fromMail = $this->Settings->find()
                    ->where(['name' => 'FROM_EMAIL'])
                    ->first();

                $from = $fromMail->value;
                $subject = $emailMessage->display;
                $link = HTTP_ROOT . 'cyfrif.com';

                $to = $postData['email'];
                $message = $this->Custom->formatSchoolRegistration(
                    $emailMessage->value,
                    $schoolName,
                    $schoolBranch,
                    $schoolAddress,
                    $date,
                    $link,
                    $subject
                );

                // Send email
                $this->sendEmailSMTP($to, 'sonupanda17@gmail.com', $subject, $message);

                if ($option === 'edit') {
                    $this->Flash->success(__('Information updated successfully.'));
                    return $this->redirect(['action' => 'schoolRegistration']);
                }

                $this->Flash->success(__('Information added successfully.'));
                return $this->redirect(['action' => 'schoolRegistration']);
            }

            $this->Flash->error(__('Unable to save the school information. Please try again.'));
        }

        $this->set(compact('allData', 'getData'));
    }
    public function schoolListing($option = null, $id = null){
        // $this->loadModel('Schools');
    
       $allData = $this->Schools->find('all');
       $getData = [];
       $new_data = [];
    
       If (!empty($option) && !empty($id)) {
           $getData = $this->Schools->find('all')->where(['id' => $id])->first();
           if ($option == "delete") {
               $this->Schools->deleteAll(['id' => $id]);
               $this->Flash->success(__('Data deleted successfuly.'));
               return $this->redirect(['action' => 'schoolListing']);
           }
           if ($option == "active") {
               $this->Schools->updateAll(['is_active' => 1], ['id' => $id]);
               $this->Flash->success(__('Data has been Activated.'));
               return $this->redirect(['action' => 'schoolRegistration']);
           }
           if ($option == "deactive") {
               $this->Schools->updateAll(['is_active' => 2], ['id' => $id]);
               $this->Flash->success(__('Data has been deactivated.'));
               return $this->redirect(['action' => 'schoolRegistration']);
           }
       }
    $this->set(compact('allData', 'getData'));
    }

    public function allStudentListing($option = null, $id = null){
        // $this->loadModel('Registrations');
    
       $allData = $this->Registrations->find('all');
       $getData = [];
       $new_data = [];
    
       If (!empty($option) && !empty($id)) {
           $getData = $this->Registrations->find('all')->where(['id' => $id])->first();
           if ($option == "delete") {
               $this->Registrations->deleteAll(['id' => $id]);
               $this->Flash->success(__('Data deleted successfuly.'));
               return $this->redirect(['action' => 'schoolListing']);
           }
           if ($option == "absent") {
            $currentStatus = $getData->active_status;
            $newStatus = ($currentStatus == 1) ? 2 : 1; 
    
            $this->Registrations->updateAll(['active_status' => $newStatus], ['id' => $id]);
            $this->Flash->success(__('Student status updated.'));
            return $this->redirect(['action' => 'AllStudentListing']);
        }
       }
    $this->set(compact('allData', 'getData'));
    }
    public function addStudent($option = null, $id = null) {
        // $this->loadModel('Registrations');
        $allData = $this->Registrations->find('all');
        
        $getData = [];
        $new_data = [];
    
        If (!empty($option) && !empty($id)) {
            $getData = $this->Registrations->find('all')->where(['id' => $id])->first();
        }
    
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $lastRegData = $this->Registrations->find('all')->order(['reg_no' => 'DESC'])->first();
            if ($lastRegData) {
                $lastRegNo = $lastRegData->reg_no;
                $numericPart = (int)substr($lastRegNo, 3); 
                $newNumericPart = $numericPart + 1;
    
                // Generate the new reg_no with the prefix 'BOG103'
                $newRegNo = 'BOG' . $newNumericPart;
            } else {
                // If no reg_no exists, start with 'BOG10301'
                $newRegNo = 'BOG10303';
            }
            $postData['reg_no'] = $newRegNo;
    
            if (($option == 'edit') && !empty($getData)) {
                $postData['id'] = $getData->id;
            }
    
            // Create a new entity and patch data
            $newEntity = $this->Registrations->newEmptyEntity();
            $newEntity = $this->Registrations->patchEntity($newEntity, $postData);
    
            // Save the entity to the database
            if ($this->Registrations->save($newEntity)) {
                if (($option == 'edit') && !empty($getData)) {
                    $this->Flash->success(__('Information updated successfully.'));
                    return $this->redirect(['action' => 'addStudent']);
                }
                $this->Flash->success(__('Information added successfully.'));
                return $this->redirect(['action' => 'addStudent']);
            } else {
                $this->Flash->error(__('Unable to save student data.'));
            }
        }
    
        $this->set(compact('allData', 'getData'));
    }
    public function offlineListing($option = null, $id = null){
    
       $allData = $this->Registrations->find('all')->where(['reg_type' => 2]);
       $getData = [];
       $new_data = [];
    
       If (!empty($option) && !empty($id)) {
           $getData = $this->Registrations->find('all')->where(['id' => $id])->first();
           if ($option == "delete") {
               $this->Registrations->deleteAll(['id' => $id]);
               $this->Flash->success(__('Data deleted successfuly.'));
               return $this->redirect(['action' => 'schoolListing']);
           }
           
       }
    $this->set(compact('allData', 'getData'));
    }
    public function onlineListing($option = null, $id = null){
    
       $allData = $this->Registrations->find('all')->where(['reg_type' => 1]);
       $getData = [];
       $new_data = [];
    
       If (!empty($option) && !empty($id)) {
           $getData = $this->Registrations->find('all')->where(['id' => $id])->first();
           if ($option == "delete") {
               $this->Registrations->deleteAll(['id' => $id]);
               $this->Flash->success(__('Data deleted successfuly.'));
               return $this->redirect(['action' => 'schoolListing']);
           }
           if ($option == "active") {
               $this->Registrations->updateAll(['is_active' => 1], ['id' => $id]);
               $this->Flash->success(__('Data has been Activated.'));
               return $this->redirect(['action' => 'schoolRegistration']);
           }
           if ($option == "deactive") {
               $this->Registrations->updateAll(['is_active' => 2], ['id' => $id]);
               $this->Flash->success(__('Data has been deactivated.'));
               return $this->redirect(['action' => 'schoolRegistration']);
           }
       }
    $this->set(compact('allData', 'getData'));
    }

    private function formatSchoolEmail() {
        $imagePath = HTTP_ROOT . 'img/campaign.png'; // Replace with your image path
        return '<!DOCTYPE html>
    <html>
    <head>
        <title>School Registration</title>
    </head>
    <body>
        <table width="750" style="font-family:Arial, Helvetica, sans-serif;" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td style="text-align:center;">
                        <h1>Welcome to Cyfrif Education Academy</h1>
                        <p>Thank you for registering your school.</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <img src="' . $imagePath . '" alt="Campaign Image" style="max-width:100%; height:auto;">
                    </td>
                </tr>
               
            </tbody>
        </table>
    </body>
    </html>';
    }
    
    // Function to send email via SMTP
    private function sendEmailSMTP($to, $from, $subject, $message) {
        $email = new Mailer();
        $email->setTransport('smtpp') // Set your email transport configuration
            ->setFrom([$from => 'Cyfrif Education Academy'])
            ->setTo($to)
            ->setEmailFormat('html')
            ->setSubject($subject)
            ->deliver($message);
    }
    
// public function excelUpload($option = null, $id = null)
// {
//     // Load Registrations model to interact with the database
//     // $this->loadModel('Registrations');

//     if ($this->request->is('post')) {
//         $data = $this->getRequest()->getData();
//         pj($data);
//         if (!empty($data['file']['name'])) {
//             $fileName = $data['file']['name'];
//             $fileTmpName = $data['file']['tmp_name'];
//             $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

//             $allowedType = ['xlsx', 'xls'];
//             if (!in_array($fileExtension, $allowedType)) {
//                 $this->Flash->error(__('Invalid File. Only Excel files are allowed.'));
//             } else {
//                 try {
//                     // Load the Excel file
//                     $spreadsheet = IOFactory::load($fileTmpName);
//                     $sheetData = $spreadsheet->getActiveSheet()->toArray();

//                     if (count($sheetData) > 1) {
//                         // Get the last used enrollment_no from the database
//                         $lastEnrollment = $this->Registrations->find()
//                             ->select(['reg_no'])
//                             ->order(['reg_no' => 'DESC'])
//                             ->first();

//                         // Extract the numeric part of the last enrollment_no (e.g., BOG10304)
//                         if ($lastEnrollment) {
//                             $lastEnrollmentNo = $lastEnrollment->reg_no;
//                             $lastNumber = (int)substr($lastEnrollmentNo, 3); // Extract number part (BOG10304 -> 10304)
//                         } else {
//                             $lastNumber = 10303; // Starting point if no previous enrollment exists (starts from BOG10303)
//                         }

//                         $connection = ConnectionManager::get('default');
//                         $flag = true;

//                         foreach ($sheetData as $row) {
//                             if ($flag) {
//                                 $flag = false; // Skip the header row
//                                 continue;
//                             }

//                             // Increment the last enrollment number for each row
//                             $lastNumber++;

//                             // Generate the new enrollment_no (BOG10304, BOG10305, etc.)
//                             $enrollmentNo = 'BOG' . $lastNumber;

//                             // Prepare the data to insert
//                             $name = $row[0];
//                             $father_name = $row[1];
//                             $mother_name = $row[2];
//                             $email = $row[3];
//                             $phone = $row[4];
//                             $school_name = $row[5];
//                             $class = $row[6];
//                             $com_address = $row[7];
//                             $school_address = $row[8];

//                             // Insert into the database
//                             $connection->insert('Registrations', [
//                                 'reg_no' => $enrollmentNo,  // Insert generated enrollment_no
//                                 'student_name' => $name,
//                                 'father_name' => $father_name,
//                                 'mother_name' => $mother_name,
//                                 'email' => $email,
//                                 'contact_no' => $phone,
//                                 'school_name' => $school_name,
//                                 'class' => $class,
//                                 'com_address' => $com_address,
//                                 'school_address' => $school_address,
//                                 'reg_type' => 2,
//                                 'active_status' => 2,
//                                 'create_dt' => date('Y-m-d'),
//                             ]);
//                             $schoolName = $postData['school_name'];
//                             $schoolBranch = $postData['branch_name'];
//                             $schoolAddress = $postData['address'];
//                             $Date = date("F d, Y");
//                             $emailMessage = $this->Settings->find('all')->where(['name' => 'Student_registration_Mail'])->first();
//                             $fromMail = $this->Settings->find('all')->where(['name' => 'FROM_EMAIL'])->first();
//                             $from = $fromMail->value;
//                             $subject = $emailMessage->display;
//                             $url = 'http://cyfrif.com';
//                             $link = '<a href="' . $url . '" target="_blank">cyfrif.com</a>';
                            

//                             $to = $postData['email']; // Assuming you have 'email' in the form data
//                             $message = $this->Custom->formatStudentRegistration($emailMessage->value, $schoolName, $schoolBranch, $schoolAddress, $Date, $link, $subject);
//                             $this->sendEmailSMTP($to, 'sudipta.nayak@cyfrif.com', $subject, $message);

//                         }
//                         $this->Flash->success(__('Excel Data Imported into the Database.'));
//                     } else {
//                         $this->Flash->error(__('The Excel file is empty or has no valid data.'));
//                     }
//                 } catch (Exception $e) {
//                     $this->Flash->error(__('Error processing the Excel file: ') . $e->getMessage());
//                 }
//             }
//         } else {
//             $this->Flash->error(__('Please choose a file to upload.'));
//         }
//     }
// }
public function excelUpload($option = null, $id = null)
    {
        // Load Registrations model to interact with the database
        // $this->loadModel('Registrations');
    
        if ($this->request->is('post')) {
            // Get the file data using the new CakePHP 5 method for file uploads
            $data = $this->getRequest()->getData();
            pj($data);
            // Get the uploaded file object from the request
            $uploadedFile = $data['file']; // This is an instance of Laminas\Diactoros\UploadedFile
    
            if ($uploadedFile instanceof UploadedFile && $uploadedFile->getError() === UPLOAD_ERR_OK) {
                $fileName = $uploadedFile->getClientFilename();
                $fileTmpName = $uploadedFile->getStream()->getMetadata('uri'); // Temporary file path
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    
                $allowedType = ['xlsx', 'xls'];
                if (!in_array($fileExtension, $allowedType)) {
                    $this->Flash->error(__('Invalid File. Only Excel files are allowed.'));
                } else {
                    try {
                        // Load the Excel file using PhpSpreadsheet (make sure you have the necessary package)
                        $spreadsheet = IOFactory::load($fileTmpName);
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();
    
                        if (count($sheetData) > 1) {
                            // Get the last used enrollment_no from the database
                            $lastEnrollment = $this->Registrations->find()
                                ->select(['reg_no'])
                                ->order(['reg_no' => 'DESC'])
                                ->first();
    
                            // Extract the numeric part of the last enrollment_no (e.g., BOG10304)
                            if ($lastEnrollment) {
                                $lastEnrollmentNo = $lastEnrollment->reg_no;
                                $lastNumber = (int)substr($lastEnrollmentNo, 3); // Extract number part (BOG10304 -> 10304)
                            } else {
                                $lastNumber = 10303; // Starting point if no previous enrollment exists (starts from BOG10303)
                            }
    
                            $connection = ConnectionManager::get('default');
                            $flag = true;
    
                            foreach ($sheetData as $row) {
                                if ($flag) {
                                    $flag = false; // Skip the header row
                                    continue;
                                }
    
                                // Increment the last enrollment number for each row
                                $lastNumber++;
    
                                // Generate the new enrollment_no (BOG10304, BOG10305, etc.)
                                $enrollmentNo = 'BOG' . $lastNumber;
    
                                // Prepare the data to insert
                                $name = $row[0];
                                $father_name = $row[1];
                                $mother_name = $row[2];
                                $email = $row[3];
                                $phone = $row[4];
                                $school_name = $row[5];
                                $class = $row[6];
                                $com_address = $row[7];
                                $school_address = $row[8];
    
                                // Insert into the database
                                $connection->insert('Registrations', [
                                    'reg_no' => $enrollmentNo,  // Insert generated enrollment_no
                                    'student_name' => $name,
                                    'father_name' => $father_name,
                                    'mother_name' => $mother_name,
                                    'email' => $email,
                                    'contact_no' => $phone,
                                    'school_name' => $school_name,
                                    'class' => $class,
                                    'com_address' => $com_address,
                                    'school_address' => $school_address,
                                    'reg_type' => 2,
                                    'active_status' => 2,
                                    'create_dt' => date('Y-m-d'),
                                ]);
                                
                                // Prepare the email notification (sending logic not changed)
                                $schoolName = $postData['school_name'];
                                $schoolBranch = $postData['branch_name'];
                                $schoolAddress = $postData['address'];
                                $Date = date("F d, Y");
                                $emailMessage = $this->Settings->find('all')->where(['name' => 'Student_registration_Mail'])->first();
                                $fromMail = $this->Settings->find('all')->where(['name' => 'FROM_EMAIL'])->first();
                                $from = $fromMail->value;
                                $subject = $emailMessage->display;
                                $url = 'http://cyfrif.com';
                                $link = '<a href="' . $url . '" target="_blank">cyfrif.com</a>';
                                
    
                                $to = $postData['email']; // Assuming you have 'email' in the form data
                                $message = $this->Custom->formatStudentRegistration($emailMessage->value, $schoolName, $schoolBranch, $schoolAddress, $Date, $link, $subject);
                                $this->sendEmailSMTP($to, 'sudipta.nayak@cyfrif.com', $subject, $message);
                            }
    
                            $this->Flash->success(__('Excel Data Imported into the Database.'));
                        } else {
                            $this->Flash->error(__('The Excel file is empty or has no valid data.'));
                        }
                    } catch (Exception $e) {
                        $this->Flash->error(__('Error processing the Excel file: ') . $e->getMessage());
                    }
                }
            } else {
                $this->Flash->error(__('Please choose a valid file to upload.'));
            }
        }
    }
}

