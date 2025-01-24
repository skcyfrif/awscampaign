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
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>


            <?= $this->Form->create('', ['type' => "post", 'role' => "form", 'id' => "forgot_password", 'url' => ['controller' => 'Ajaxs', 'action' => 'forgotPassword']]); ?>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Request new password</button>
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

        $('#forgot_password').validate({
            submitHandler: function(form) {

                jQuery.ajax({
                    type: 'POST',
                    data: {email: $('#email').val()},
                    dataType: 'json',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-Token',<?= json_encode($this->request->getParam('_csrfToken')); ?>);
                    },
                    url: '<?= HTTP_ROOT; ?>ajaxs/checkEmail',
                }).done(function(res) {
                    $('.full_loading').hide();
                    if (res.status == 'error') {
                        alert('Email not found');
                        $('#user_email').val('');
                        return false;
                    }
                    if (res.status == 'success') {
                        form.submit();
                        return true;
                    }

                }).fail(function() {
                    alert('Error found. Try again..');
                    return false;
                });

                return false;
            },
            rules: {
                email: {
                    required: true,
                    email: true,
                }

            },
            messages: {
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a vaild email address"
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