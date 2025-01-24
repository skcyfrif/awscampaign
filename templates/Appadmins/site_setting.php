<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Site setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Site setting</li>
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

                        <div class="card-header">
                            <h3 class="card-title">Site Setting</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">                                        
                            <?php echo $this->Form->create(null, ['type' => 'file', 'id' => 'logo_form']); ?>
                            <div class="row form-group">
                                <div class="col-12 col-md-2">
                                    <label for="product_id" class=" form-control-label">Logo</label>
                                </div>
                                <div class="col-6 col-md-8">
                                    <input type="file" id="logo"  class="form-control" name="logo" required>         
                                    <small class="text-danger"> <br>only png allowed.</small>
                                    <div><img src="<?= HTTP_ROOT; ?>img/logo.png"  alt="logo" width="185"></div>
                                </div>
                                <div class="col-6 col-md-2">
                                    <button class="btn btn-success">Submit</button>                                                  
                                </div>
                            </div>

                            <?php echo $this->Form->end(); ?>

                            <?php echo $this->Form->create(null, ['type' => 'file', 'id' => 'icon_form']); ?>
                            <div class="row form-group">
                                <div class="col-12 col-md-2">
                                    <label for="product_id" class=" form-control-label">Site icon</label>
                                </div>
                                <div class="col-6 col-md-8">
                                    <input type="file" id="icon"  class="form-control" name="icon" required>          
                                    <small class="text-danger"> <br>only png allowed.</small>
                                    <div><img src="<?= HTTP_ROOT; ?>img/logo.png"  alt="logo" width="50"></div>
                                </div>
                                <div class="col-6 col-md-2">
                                    <button class="btn btn-success">Submit</button>                                                  
                                </div>
                            </div>

                            <?php echo $this->Form->end(); ?>


                            <?php echo $this->Form->create(null, ['type' => 'file', 'id' => 'site_form']); ?>
                            <div class="row form-group">
                                <div class="col-12 col-md-2">
                                    <label for="product_id" class=" form-control-label">Site name</label>
                                </div>
                                <div class="col-6 col-md-8">
                                    <input type="text" id="icon"  class="form-control" name="site_name" value="<?= !empty($site_name->value) ? $site_name->value : ''; ?>" required>

                                </div>


                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-2">
                                    <label for="product_id" class=" form-control-label">Site short name</label>
                                </div>
                                <div class="col-6 col-md-8">
                                    <input type="text" id="icon"  class="form-control" name="site_short_name" value="<?= !empty($site_short_name->value) ? $site_short_name->value : ''; ?>" required>

                                </div>
                                <div class="col-6 col-md-2"></div>
                                <div class="col-6 col-md-2">
                                    <button class="btn btn-success">Submit</button>                                                  
                                </div>
                            </div>

                            <?php echo $this->Form->end(); ?>

                        </div>


                    </div>
                    <!-- /.card -->
                </div>

            </div>


            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

    $(document).ready(function() {

        $('#site_form').validate({

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
        $('#icon_form').validate({

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
        $('#logo_form').validate({

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





</script>