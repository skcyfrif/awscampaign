<div class="login-box">
    <div class="login-logo">
        <!-- Optional: You can add a logo here if desired -->
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <!-- Corrected FormHelper::create usage -->
            <?= $this->Form->create(null, ['type' => 'post', 'role' => 'form', 'id' => 'LoginForm']); ?>
            
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" required autocomplete="off">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password" required minlength="5" autocomplete="off">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-8">
                    <p class="mb-1">
                        <a href="<?= $this->Url->build('/admin-forgot-password'); ?>">I forgot my password</a>
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
            
            <?= $this->Form->end(); ?>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#LoginForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
            },
            messages: {
                email: {
                    required: "Please enter an email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                }
            },
            errorElement: 'span',
            errorClass: 'error',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
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
