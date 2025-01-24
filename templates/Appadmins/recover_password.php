<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo HTTP_ROOT; ?>appadmins/dashboard" class="brand-link" style="text-align: center;">
            <img src="<?php echo HTTP_ROOT; ?>img/logo.png" alt="Logo" class="brand-image img elevation-3" style="opacity: .8;float:none !important;width: 50%;max-height: inherit;">
    <!--        <span class="brand-text font-weight-light">Classified</span>-->
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

            <?= $this->Form->create('', ['type' => "post", 'role' => "form", 'id' => "changePasswordForm"]); ?>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Change password</button>
                </div>
                <!-- /.col -->
            </div>
            <?= $this->Form->end(); ?>

            <p class="mt-3 mb-1">
                <a href="<?= HTTP_ROOT; ?>admin-login">Login</a>
            </p>


        </div>
        <!-- /.login-card-body -->
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
//        $.validator.setDefaults({
//            submitHandler: function() {
//                alert("Form successful submitted!");
//            }
//        });
        $('#changePasswordForm').validate({
            rules: {
                confirm_password: {
                    required: true,
                    equalTo: '#password',
                },
                password: {
                    required: true,
                    minlength: 5
                },

            },
            messages: {
                confirm_password: {
                    required: "Please enter a confirm password",
                    equalTo: "Your confirm password must be same as password"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                }
            },
            errorElement: 'span',
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
<style>
    span.error {
        color: red;
        position: absolute;
        font-size: 12px;
        bottom: -20px;
    }
    .input-group.mb-3 {
        margin-bottom: 25px !important;
    }
</style>