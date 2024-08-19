<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.themenate.net/espire/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Aug 2024 04:39:45 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Videos</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/admin/images/logo/favicon.ico">

    <!-- page css -->
    <link href="<?php echo base_url() ?>/assets/admin/vendors/apexcharts/dist/apexcharts.css" rel="stylesheet">

    <!-- Core css -->
    <link href="<?php echo base_url() ?>/assets/admin/css/app.min.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>/assets/admin/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">

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

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            $.toast({
                heading: 'Success',
                text: ' <?php echo session()->getFlashdata('success') ?>',
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3500,
                stack: 6
            })
        </script>


    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            $.toast({
                heading: 'Error',
                text: ' <?php echo session()->getFlashdata('error') ?>',
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'error',
                hideAfter: 3500,
                stack: 6
            })
        </script>

    <?php endif; ?>

    <script>
        function toastt(heading, type, message) {
            $.toast({
                heading: heading,
                text: message,
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: type,
                hideAfter: 3500,
                stack: 6
            })
        }
    </script>
</body>


<!-- Mirrored from www.themenate.net/espire/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Aug 2024 04:40:59 GMT -->

</html>