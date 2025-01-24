<?php
$paramController = $this->request->getParam('controller');
$paramAction = $this->request->getParam('action');
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= HTTP_ROOT; ?>appadmins/dashboard" class="brand-link" style="text-align: center;">
        <img src="<?= HTTP_ROOT; ?>img/favicon.png" alt="Logo" class="brand-image img elevation-3"
             style="opacity: .8;float:none !important;">
<!--        <span class="brand-text font-weight-light">Classified</span>-->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo $this->User->profilePicture(1); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= HTTP_ROOT; ?>appadmins/account-setting" class="d-block"><?= $this->getRequest()->getSession()->read('Auth.User.name'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="<?= HTTP_ROOT; ?>appadmins/dashboard" class="nav-link <?php
                    if ($paramController == "Appadmins" && $paramAction == "dashboard") {
                        echo "active";
                    }
                    ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>  Dashboard   </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?= HTTP_ROOT; ?>appadmins/school_registration" class="nav-link <?php
                    if ($paramController == "Appadmins" && $paramAction == "schoolRegistration") {
                        echo "active";
                    }
                    ?>">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>  School Registration </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?= HTTP_ROOT; ?>appadmins/school_listing" class="nav-link <?php
                    if ($paramController == "Appadmins" && $paramAction == "schoolListing") {
                        echo "active";
                    }
                    ?>">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>  School Listing </p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php
                if ($paramController == "Appadmins" && in_array($paramAction, ["onlineListing", "offlinrListing", "allStudentListing", "excelUpload"])) {
                    echo "menu-open";
                }
                ?>">
                    <a href="#" class="nav-link " >
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Student Registration
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" <?php
                    if ($paramController == "Appadmins" && in_array($paramAction, ["addStudent", "onlineListing", "offlineListing", "allStudentListing", "excelUpload"])) {
                        echo "style='display:block;'";
                    }
                    ?>>
                         <li class="nav-item">
                            <a href="<?= HTTP_ROOT; ?>appadmins/add_student" class="nav-link <?php
                            if ($paramController == "Appadmins" && $paramAction == "addStudent") {
                                echo "active";
                            }
                            ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Student</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= HTTP_ROOT; ?>appadmins/offline_listing" class="nav-link <?php
                            if ($paramController == "Appadmins" && $paramAction == "offlineListing") {
                                echo "active";
                            }
                            ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Offline Student list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= HTTP_ROOT; ?>appadmins/online_listing" class="nav-link <?php
                            if ($paramController == "Appadmins" && $paramAction == "onlineListing") {
                                echo "active";
                            }
                            ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Online Student list</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= HTTP_ROOT; ?>appadmins/all_student_listing" class="nav-link <?php
                            if ($paramController == "Appadmins" && $paramAction == "allStudentListing") {
                                echo "active";
                            }
                            ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Student list</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= HTTP_ROOT; ?>appadmins/excel_upload" class="nav-link <?php
                            if ($paramController == "Appadmins" && $paramAction == "excelUpload") {
                                echo "active";
                            }
                            ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Excel Upload</p>
                            </a>
                        </li>
                     
                    </ul>
                     
                
               
                </li>

                <li class="nav-item has-treeview <?php
                if ($paramController == "Appadmins" && in_array($paramAction, ["accountSetting", "siteSetting", "emailTemplate"])) {
                    echo "menu-open";
                }
                ?>">
                    <a href="#" class="nav-link " >
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Setting
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" <?php
                    if ($paramController == "Appadmins" && in_array($paramAction, ["accountSetting", "siteSetting", "emailTemplate"])) {
                        echo "style='display:block;'";
                    }
                    ?>>

                        <li class="nav-item">
                            <a href="<?= HTTP_ROOT; ?>appadmins/account_setting" class="nav-link <?php
                            if ($paramController == "Appadmins" && $paramAction == "accountSetting") {
                                echo "active";
                            }
                            ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Account Setting</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= HTTP_ROOT; ?>appadmins/site_setting" class="nav-link <?php
                            if ($paramController == "Appadmins" && $paramAction == "siteSetting") {
                                echo "active";
                            }
                            ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Site Setting</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= HTTP_ROOT; ?>appadmins/email_template" class="nav-link <?php
                            if ($paramController == "Appadmins" && $paramAction == "emailTemplate") {
                                echo "active";
                            }
                            ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Email Template</p>
                            </a>
                        </li>
                     
                    </ul>
                     
                
               
                </li>


                

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>