<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Email Templates</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Email Templates</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <?php
                        if (!empty($getData)) {
                            echo $this->Form->create(null, ['type' => 'file', 'id' => 'email_template_form']);
                            ?>
                            <div class="card-header">
                                <h3 class="card-title">Email Templates</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <div class="card-body">                                        
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="name" class=" form-control-label">Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" placeholder="Text content" class="form-control" disabled value="<?= !empty($getData) ? $getData->name : ''; ?>">                                                   
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="name" class=" form-control-label">MAIL FOR</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" placeholder="Text content" class="form-control" name="display" value="<?= !empty($getData) ? $getData->display : ''; ?>" required="">                                                   
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="url" class=" form-control-label">Message body</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="value" id="value" rows="5" required><?= $getData->value; ?></textarea>
                                        <small class="text-danger">Don't change or remove text inside "[]" like [EMAIL] or [NAME]</small>
                                    </div>
                                </div>


                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?=HTTP_ROOT;?>appadmins/email_template/" role="button" class="btn btn-danger">Cancel</a>
                            </div>
                            <?php
                            echo $this->Form->end();
                        }
                        ?>
                    </div>
                    <!-- /.card -->
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="title-1">All Available Email Templates</h3>
                        </div>

                        <div class="card-body"> 
                            <div class="table-responsive table--no-card m-b-40" id="list">
                                <table class="table table-borderless table-striped table-earning" id="example">
                                    <thead>
                                        <tr>
                                            <th  class="text-center">Sl. no.</th>
                                            <th  class="text-center">Name</th>
                                            <th  class="text-center">For</th>
                                            <th  class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($allData as $val) {
                                            ?>
                                            <tr id="arrayorder_<?= $val->id; ?>" class="message_box ui-sortable-handle">
                                                <td  class="text-center"><?= $i++; ?></td>
                                                <td  class="text-center"><?= $val->name; ?></td>
                                                <td  class="text-center"><?= $val->display; ?></td>
                                                <td class="text-center">

                                                    <a  href="<?= HTTP_ROOT; ?>appadmins/email_template/edit/<?= $val->id; ?>"  title="Edit" ><i class="fa fa-edit text-info"></i></a>

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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?= HTTP_ROOT; ?>js/ck/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('#example').DataTable();
        $('#email_template_form').validate({

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });



    CKEDITOR.replace('value');

</script>