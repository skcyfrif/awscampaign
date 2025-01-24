<script src="<?= HTTP_ROOT; ?>js/ck/ckeditor/ckeditor.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student Registration</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Student Registration</li>
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
                                <label for="site_url" class=" form-control-label">Student Name</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="text" id="site_url"  class="form-control" name="student_name" required value="<?php
                                if (!empty($getData)) {
                                    echo $getData->student_name;
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="site_url" class=" form-control-label">Father Name</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="text" id="site_url"  class="form-control" name="father_name" required value="<?php
                                if (!empty($getData)) {
                                    echo $getData->father_name;
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="site_url" class=" form-control-label">Mother Name</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="text" id="site_url"  class="form-control" name="mother_name" required value="<?php
                                if (!empty($getData)) {
                                    echo $getData->mother_name;
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
                                <label for="site_url" class=" form-control-label">Class Name</label>
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
                                <label for="description" class=" form-control-label">Communication Address</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <textarea id="address"  class="form-control" name="com_address" required rows="3"><?php
                                    if (!empty($getData)) {
                                        echo $getData->com_address;
                                    }
                                    ?></textarea>
                            </div>
                        </div>              
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="description" class=" form-control-label">School Address</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <textarea id="address"  class="form-control" name="school_address" required rows="3"><?php
                                    if (!empty($getData)) {
                                        echo $getData->school_address;
                                    }
                                    ?></textarea>
                            </div>
                        </div>

                        <script type="text/javascript">
                            CKEDITOR.replace('description');
                        </script>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="<?= HTTP_ROOT; ?>appadmins/add_student" class="btn btn-danger">Cancel</a>
<?= $this->Form->end(); ?>
                    </div>
                    <button type="button" id="verifyBtn" data-toggle="modal" data-target="#verifyModal">Login to Download Hall Ticket</button>

<!-- Verification Modal (Popup) -->
<div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifyModalLabel">Verify Your Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create(null, ['url' => ['action' => 'hallTicket']]); ?>
                <?php
                    echo $this->Form->control('reg_no', ['label' => 'Registration Number']);
                    echo $this->Form->control('date_of_birth', ['type' => 'text', 'label' => 'Date of Birth']);
                ?>
                <?php echo $this->Form->button(__('Verify and Download Hall Ticket')); ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
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

