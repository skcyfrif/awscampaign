<script src="<?= HTTP_ROOT; ?>js/ck/ckeditor/ckeditor.js"></script>

  
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Online Student List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?= HTTP_ROOT; ?>appadmins/add_student"  title="Add" ><i class="fa fa-add text-info"></i>Add Student</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
     
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
    
                  
       </div>
    </div>
  </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="title-1">Online Student List </h3>                        
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>                                   
                                    <th>Sl. no.</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Mother Name</th>
                                    <th>School Name</th>
                                    <th>Class</th>
                                    <th>Contact No</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    
                                    
                                    
                                </tr>
                            </thead>
                            <tbody id="list">
                                <?php
                                foreach ($allData as $key => $data) { 
                                    ?>
                                    <tr  id="arrayorder_<?php echo $data->id; ?>" class="message_box ui-sortable-handle">

                                        <td valign="middle"><?= $key + 1; ?></td>
                                        <td valign="middle"><?= $data->student_name;?></td>
                                        <td valign="middle"><?= $data->father_name; ?></td>
                                        <td valign="middle"><?= $data->mother_name; ?></td>
                                        <td valign="middle"><?= $data->school_name; ?></td>
                                        <td valign="middle"><?= $data->class; ?></td>
                                        <td valign="middle"><?= $data->contact_no; ?></td>
                                        <td valign="middle"><?= $data->email; ?></td>                                                            
                                        <td valign="middle"><a href="<?= HTTP_ROOT . 'appadmins/add_student/edit/' . $data->id; ?>" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a></td>
                                        <td valign="middle"><a onclick="return confirm('Are you sure want to delete?');" href="<?= HTTP_ROOT . 'appadmins/all_school_listing/delete/' . $data->id; ?>" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a></td>
                                                          
                                                            
                                     
                                        
                                    </tr>
<?php } ?>
                            </tbody>
                    </table>
                 </div>
              </div>
           </div>
       </div>
    </div>
  </section>
</div>


