<?php

use App\Modules\Settings\Models\Settings_m;

$setmodel = new Settings_m();
$settings = (object) $setmodel->find_set(1);


?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Apr 2024 13:51:23 GMT -->

<head>

    <meta charset="utf-8" />
    <title>R MEDIAHUB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/admin/images/favicon.ico"> -->
    <link rel="shortcut icon" href="<?php echo isset($settings->logopath) ? base_url($settings->logopath)  : '' ?>">

    <!-- plugin css -->
    <link href="<?php echo base_url() ?>/assets/admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <!-- dropzone css -->
    <!-- <link href="<?php echo base_url() ?>/assets/admin/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">

    <!-- preloader css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url() ?>/assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url() ?>/assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url() ?>/assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url() ?>/assets/admin/libs/jquery/jquery.min.js"></script>

    <!-- Media PLAYER -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/admin/build/mediaelementplayer.min.css" />


    <!-- choises -->
    <link href="<?php echo base_url() ?>assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url() ?>/assets/admin/build/mediaelement-and-player.js"></script>

    <!-- Dailymotion Renderer -->

    <script src="<?php echo base_url() ?>/assets/admin/build/renderers/dailymotion.js"></script>

    <!-- Facebook Video Renderer -->

    <script src="<?php echo base_url() ?>/assets/admin/build/renderers/facebook.js"></script>

    <!-- Soundcloud Renderer -->

    <script src="<?php echo base_url() ?>/assets/admin/build/renderers/soundcloud.js"></script>

    <!-- Twitch Renderer -->

    <script src="<?php echo base_url() ?>/assets/admin/build/renderers/twitch.js"></script>

    <!-- Vimeo Renderer -->

    <script src="<?php echo base_url() ?>/assets/admin/build/renderers/vimeo.js"></script>

    <!-- Youtube Renderer -->

    <script src="<?php echo base_url() ?>/assets/admin/build/renderers/youtube.js"></script>

    <!-- All Languages -->
    <script src="<?php echo base_url() ?>/assets/admin/build/lang/ca.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/cs.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/de.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/es.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/fa.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/fr.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/hr.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/hu.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/it.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/ja.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/ko.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/ms.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/nl.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/pl.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/pt.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/ro.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/ru.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/sk.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/sv.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/tr.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/to/build/lang/uk.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/build/lang/zh-cn.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/to/build/lang/zh.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <!-- Icons Css -->
    <link href="<?php echo base_url() ?>/assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!--Toaster Popup message CSS -->
    <link href="<?php echo base_url() ?>assets/admin/vendors/toast-master/css/jquery.toast.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="<?php echo base_url() ?>assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?php echo base_url() ?>assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url() ?>assets/admin/vendors/select2/select2.min.css" rel="stylesheet" />
    <script src="<?php echo base_url() ?>assets/admin/vendors/select2/select2.min.js"></script>
</head>


<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <?php include(APPPATH . 'Views/partials/admin/header.php') ?>

        <!-- ========== Left Sidebar Start ========== -->
        <?php include(APPPATH . 'Views/partials/admin/sidebar.php') ?>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <!-- <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div> -->
                    <!-- end page title -->

                    <?php $this->renderSection('content') ?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <?php include(APPPATH . 'Views/partials/admin/footer.php') ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right Sidebar -->
    <?php include(APPPATH . 'Views/partials/admin/right.php') ?>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url() ?>/assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="<?php echo base_url() ?>/assets/admin/libs/pace-js/pace.min.js"></script>

    <!-- apexcharts -->
    <script src="<?php echo base_url() ?>/assets/admin/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Plugins js-->
    <script src="<?php echo base_url() ?>/assets/admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/admin/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
    <!-- dashboard init -->
    <script src="<?php echo base_url() ?>/assets/admin/js/pages/dashboard.init.js"></script>

    <script src="<?php echo base_url() ?>/assets/admin/js/app.js"></script>

    <!-- fontawesome icons init -->
    <script src="<?php echo base_url() ?>/assets/admin/js/pages/fontawesome.init.js"></script>

    <!-- Popup message jquery -->
    <script src="<?php echo base_url() ?>assets/admin/vendors/toast-master/js/jquery.toast.js"></script>

    <!-- Required datatable js -->
    <script src="<?php echo base_url() ?>assets/admin/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="<?php echo base_url() ?>assets/admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/libs/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <!-- Responsive examples -->
    <script src="<?php echo base_url() ?>assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="<?php echo base_url() ?>assets/admin/js/pages/datatables.init.js"></script>


    <!-- choices -->
    <!-- choices js -->
    <script src="<?php echo base_url() ?>assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

    <script>
        $('.data-table, .datatable').DataTable({
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


        $(document).ready(function() {
            $('.select,.form-select').select2();
        });
    </script>

    <script>
        $('video, audio').mediaelementplayer({
            enableAutosize: true,
            timeFormat: 'mm:ss',
            // showTimecodeFrameCount:true,
            autosizeProgress: true,
            alwaysShowControls: true,
            clickToPlayPause: true,
            features: [playpause, current, progress, duration, tracks, volume, fullscreen],

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


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Apr 2024 13:51:26 GMT -->

</html>