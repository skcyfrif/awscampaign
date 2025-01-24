<script src="<?= HTTP_ROOT; ?>js/ck/ckeditor/ckeditor.js"></script>

  
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?= HTTP_ROOT; ?>appadmins/categories/add/"  title="Add" ><i class="fa fa-add text-info"></i>Add</a></li>
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
                        <h3 class="title-1">Listing Category </h3>                        
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>                                   
                                    <th>Sl. no.</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    
                                    
                                    
                                    
                                </tr>
                            </thead>
                            <tbody id="list">
                                <?php
                                foreach ($allData as $key => $data) { 
                                    ?>
                                    <tr  id="arrayorder_<?php echo $data->id; ?>" class="message_box ui-sortable-handle">

                                        <td valign="middle"><?= $key + 1; ?></td>
                                        <td valign="middle"><?= $data->cat_name; ?></td>
                                        <td valign="middle"><?= $data->status; ?></td>
                                        <td valign="middle">
                                            <a href="<?= HTTP_ROOT . 'appadmins/categories/edit/' . $data->id; ?>" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                            <?php if ($data->status == 1) { ?>
                                                <a href="<?= HTTP_ROOT . 'appadmins/categories/deactive/' . $data->id; ?>" class="btn btn-info" title="Click to deactive"><i class="fa fa-times"></i></a>
                                            <?php } else { ?>
                                                <a href="<?= HTTP_ROOT . 'appadmins/categories/active/' . $data->id; ?>" class="btn btn-success" title="Click to active"><i class="fa fa-check"></i></a>
    <?php } ?>

                                            <a onclick="return confirm('Are you sure want to delete?');" href="<?= HTTP_ROOT . 'appadmins/categories/delete/' . $data->id; ?>" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>                                            
                                        </td>                 
                                     
                                        
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


