<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Admin ||</title>
        <link rel="icon" href="<?= HTTP_ROOT; ?>img/logo.png" type="image/png" sizes="16x16"> 

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?= HTTP_ROOT; ?>admin_assets/plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?= HTTP_ROOT; ?>admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        

        <!-- DataTables -->
        <link rel="stylesheet" href="<?= HTTP_ROOT; ?>admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= HTTP_ROOT; ?>admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <!-- jQuery -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- DataTables -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

        <!-- jquery-validation -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/jquery-validation/additional-methods.min.js"></script>

        <!-- bootstrap datepicker -->
        <link href="<?= HTTP_ROOT; ?>datepicker/datepicker.css" rel="stylesheet">
        <script src="<?= HTTP_ROOT; ?>datepicker/bootstrap-datepicker.js"></script>

        <!-- Select2 -->
        <link rel="stylesheet" href="<?= HTTP_ROOT; ?>admin_assets/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="<?= HTTP_ROOT; ?>admin_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/select2/js/select2.full.min.js"></script>
        
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= HTTP_ROOT; ?>admin_assets/dist/css/adminlte.min.css">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <?php echo $this->element('admin-header'); ?>
            <?php echo $this->element('admin-sidebar'); ?>
            <?= $this->Flash->render() ?>

            <?= $this->fetch('content') ?>

            <?php echo $this->element('admin-footer'); ?>

        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->


        <!-- overlayScrollbars -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/dist/js/adminlte.js"></script>

        <!-- OPTIONAL SCRIPTS -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/dist/js/demo.js"></script>

        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/raphael/raphael.min.js"></script>
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
        <!-- ChartJS -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/plugins/chart.js/Chart.min.js"></script>

        <!-- PAGE SCRIPTS -->
        <script src="<?= HTTP_ROOT; ?>admin_assets/dist/js/pages/dashboard2.js"></script>


    </body>
</html>

