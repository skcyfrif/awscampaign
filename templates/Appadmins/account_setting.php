<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Account setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account setting</li>
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

                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-account_tab" data-toggle="pill" href="#account_tab" role="tab" aria-controls="account_tab" aria-selected="false">Account Setting</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-email_tab" data-toggle="pill" href="#email_tab" role="tab" aria-controls="email_tab" aria-selected="false">Email Setting</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-password_tab" data-toggle="pill" href="#password_tab" role="tab" aria-controls="password_tab" aria-selected="false">Change Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-paypal_tab" data-toggle="pill" href="#paypal_tab" role="tab" aria-controls="paypal_tab_tab" aria-selected="false">Paypal</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade active show" id="account_tab" role="tabpanel" aria-labelledby="account_tab">
                                        <h3 class="title-1 m-b-25">Account</h3>
                                        <?= $this->Form->create(null, ['type' => 'file', 'url' => ['action' => 'accountUpdate'], 'id' => 'account_form']); ?>
                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="name" class=" form-control-label">Name</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <input type="text" id="name"  class="form-control" name="name" value="<?= !empty($userData->name) ? $userData->name : ''; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="name" class=" form-control-label">Login Email</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <input type="text" id="email"  class="form-control" name="email" value="<?= !empty($userData->email) ? $userData->email : ''; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="gender" class=" form-control-label">Gender</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <select name="gender" id="gender" required class="form-control">
                                                    <option value="" disabled selected > Select gender</option>
                                                    <?php
                                                    $gender = ['Male', 'Female', 'Other'];
                                                    foreach ($gender as $val) {
                                                        ?>
                                                        <option value="<?= $val; ?>" <?= (!empty($userData->user_detail->gender) && $val == $userData->user_detail->gender) ? 'selected' : ''; ?>> <?= $val; ?> </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="phone_number" class=" form-control-label">Phone number</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <input type="number" id="phone_number"  class="form-control" name="phone_number" value="<?= !empty($userData->user_detail->phone_number) ? $userData->user_detail->phone_number : ''; ?>" required maxlength="12">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="file_input" class=" form-control-label">Profile picture</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <input type="file" id="file_input"  class="form-control" name="file_input">
                                                <?php
                                                if (!empty($userData->user_detail->photo)) {
                                                    echo '<div><img src="' . HTTP_ROOT . $userData->user_detail->path . $userData->user_detail->photo . '" alt="photo" width="200"></div>';
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="address" class=" form-control-label">Address</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <textarea id="address"  class="form-control" name="address" required><?= !empty($userData->user_detail->address) ? $userData->user_detail->address : ''; ?></textarea>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-success">Update</button>
                                        <?= $this->Form->end(); ?>
                                    </div>
                                    <div class="tab-pane fade" id="email_tab" role="tabpanel" aria-labelledby="email_tab">
                                        <h3 class="title-1 m-b-25">Mail Setting</h3>
                                        <?= $this->Form->create(null, ['type' => 'file', 'url' => ['action' => 'mailUpdate'], 'id' => 'email_sett_form']); ?>
                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="from_mail" class=" form-control-label">FROM MAIL</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <input type="email" id="from_mail"  class="form-control" name="from_mail" value="<?= !empty($from_mail->value) ? $from_mail->value : ''; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="admin_mail" class=" form-control-label">ADMIN MAIL</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <input type="email" id="admin_mail"  class="form-control" name="admin_mail" value="<?= !empty($admin_mail->value) ? $admin_mail->value : ''; ?>" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <?= $this->Form->end(); ?>
                                    </div>
                                    <div class="tab-pane fade" id="password_tab" role="tabpanel" aria-labelledby="password_tab">
                                        <h3 class="title-1 m-b-25">Change Password</h3>
                                        <?= $this->Form->create(null, ['type' => 'file', 'url' => ['action' => 'changePassword'], 'id' => 'password_form']); ?>
                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="password" class=" form-control-label">Password</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <input type="password" id="password"  class="form-control" name="password"  required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="confirm_password" class=" form-control-label">Confirm Password</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <input type="password" id="confirm_password"  class="form-control" name="confirm_password"  required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <?= $this->Form->end(); ?>
                                    </div>
                                    <div class="tab-pane fade" id="paypal_tab" role="tabpanel" aria-labelledby="paypal_tab">
                                        <h3 class="title-1 m-b-25">Paypal setting</h3>
                                        <?= $this->Form->create(null, ['type' => 'file', 'url' => ['action' => 'updatePaypal'], 'id' => 'paypal_form']); ?>
                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="client_id" class=" form-control-label">client_id</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <input type="text" id="client_id"  class="form-control" name="client_id"  required value="<?= @$paypal_details->client_id; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-12 col-md-3">
                                                <label for="client_secret" class=" form-control-label">client_secret</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <input type="text" id="client_secret"  class="form-control" name="client_secret"  required value="<?= $paypal_details->client_secret; ?>">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <?= $this->Form->end(); ?>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card -->
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

    $(document).ready(function () {

        $('#email_sett_form').validate({

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
        $('#account_form').validate({

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
        $('#password_form').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
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

        $('#paypal_form').validate({

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
    });


</script>
