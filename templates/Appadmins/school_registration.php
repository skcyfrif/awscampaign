<script src="<?= HTTP_ROOT; ?>js/ck/ckeditor/ckeditor.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>School Registration</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">School Registration</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add/Edit Registration </h3>                        
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?= $this->Form->create(null, ['type' => 'post']); ?>                      
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="site_url" class=" form-control-label">School Name</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="text" id="site_url"  class="form-control" name="school_name" required value="<?php
                                if (!empty($getData)) {
                                    echo $getData->school_name;
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="site_url" class=" form-control-label">Email Id</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="text" id="site_url"  class="form-control" name="email" required value="<?php
                                if (!empty($getData)) {
                                    echo $getData->email;
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="site_url" class=" form-control-label">Contact No</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="text" id="site_url"  class="form-control" name="contact_no" required value="<?php
                                if (!empty($getData)) {
                                    echo $getData->contact_no;
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="site_url" class=" form-control-label">Authorized No</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="text" id="site_url"  class="form-control" name="auth_no" required value="<?php
                                if (!empty($getData)) {
                                    echo $getData->auth_no;
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="site_url" class=" form-control-label">Class Strength</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="text" id="site_url"  class="form-control" name="class" required value="<?php
                                if (!empty($getData)) {
                                    echo $getData->class;
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="site_url" class=" form-control-label">Branch Name</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="text" id="site_url"  class="form-control" name="branch_name" required value="<?php
                                if (!empty($getData)) {
                                    echo $getData->branch_name;
                                }
                                ?>">
                            </div>
                        </div>               
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="description" class=" form-control-label">Address</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <textarea id="address"  class="form-control" name="address" required rows="3"><?php
                                    if (!empty($getData)) {
                                        echo $getData->address;
                                    }
                                    ?></textarea>
                            </div>
                        </div>

                        <script type="text/javascript">
                            CKEDITOR.replace('description');
                        </script>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="<?= HTTP_ROOT; ?>appadmins/school_registration" class="btn btn-danger">Cancel</a>
<?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<script>
    $('#banner_form').validate({
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>

