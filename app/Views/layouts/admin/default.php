<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.themenate.net/espire/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Aug 2024 04:39:45 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>R MEDIAHUB</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/admin/images/logo/favicon.ico">

    <!-- page css -->
    <link href="<?php echo base_url() ?>/assets/admin/vendors/apexcharts/dist/apexcharts.css" rel="stylesheet">

    <!-- Core css -->
    <link href="<?php echo base_url() ?>/assets/admin/css/app.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="<?php echo base_url() ?>/assets/admin/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!--Toaster Popup message CSS -->
    <link href="<?php echo base_url() ?>assets/admin/vendors/toast-master/css/jquery.toast.css" rel="stylesheet">

    <!-- Core Vendors JS -->
    <script src="<?php echo base_url() ?>/assets/admin/js/vendors.min.js"></script>

    <!-- Core JS -->
    <script src="<?php echo base_url() ?>/assets/admin/js/app.min.js"></script>
</head>

<body>
    <div class="layout">
        <div class="vertical-layout">
            <!-- Header START -->
            <?php include(APPPATH . 'Views/partials/admin/header.php') ?>
            <!-- Header END -->

            <!-- Side Nav START -->
            <?php include(APPPATH . 'Views/partials/admin/sidebar.php') ?>
            <!-- Side Nav END -->

            <!-- Content START -->
            <div class="content">
                <div class="main">
                    <?php $this->renderSection('content') ?>
                </div>
                <!-- Footer START -->
                <div class="footer">
                    <?php include(APPPATH . 'Views/partials/admin/footer.php') ?>
                </div>
                <!-- Footer End -->
            </div>
            <!-- Content END -->

            <!-- Quick View START -->
            <?php include(APPPATH . 'Views/partials/admin/quickstart.php') ?>
            <!-- Quick View END -->
        </div>
    </div>

    <!-- page js -->
    <script src="<?php echo base_url() ?>/assets/admin/vendors/apexcharts/dist/apexcharts.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/js/pages/dashboard.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/vendors/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Popup message jquery -->
    <script src="<?php echo base_url() ?>assets/admin/vendors/toast-master/js/jquery.toast.js"></script>


    <!-- Datatables -->
    <script src="<?php echo base_url() ?>/assets/admin/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script>
        $('.data-table').DataTable({
            'columnDefs': [{
                'orderable': false,
                'targets': 0
            }],

            dom: '<"top"lBf>rtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ],
            pageLength: 25,
            initComplete: function() {
                // Optionally, you can add custom styling here if needed
            }
        });
    </script>


</body>


<!-- Mirrored from www.themenate.net/espire/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Aug 2024 04:40:59 GMT -->

</html>