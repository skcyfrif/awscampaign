<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title><?= $title; ?></title>
        <link rel="icon" href="<?= HTTP_ROOT; ?>img/logo.png" type="image/png" sizes="16x16"> 
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?= HTTP_ROOT; ?>admin_assets/plugins/fontawesome-free/css/all.min.css">

        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="<?= HTTP_ROOT; ?>admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= HTTP_ROOT; ?>admin_assets/dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <!-- jQuery -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>



        <!-- jquery-validation -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/jquery-validation/additional-methods.min.js"></script>


    </head>
    <body class="hold-transition login-page">

        <?= $this->Flash->render() ?>

        <?= $this->fetch('content') ?>

        <!-- AdminLTE App -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/dist/js/adminlte.min.js"></script>


    </body>
</html>

