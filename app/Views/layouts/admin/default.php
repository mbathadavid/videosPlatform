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

    
    <!-- Core Vendors JS -->
    <script src="<?php echo base_url() ?>/assets/admin/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="<?php echo base_url() ?>/assets/admin/vendors/apexcharts/dist/apexcharts.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/js/pages/dashboard.js"></script>

    <!-- Core JS -->
    <script src="<?php echo base_url() ?>/assets/admin/js/app.min.js"></script>

</body>


<!-- Mirrored from www.themenate.net/espire/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Aug 2024 04:40:59 GMT -->
</html>