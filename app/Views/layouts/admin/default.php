<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Apr 2024 13:51:23 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Minia - Minimal Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/admin/images/favicon.ico">

    <!-- plugin css -->
    <link href="<?php echo base_url() ?>/assets/admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <!-- dropzone css -->
    <link href="<?php echo base_url() ?>/assets/admin/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

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
                    <div class="row">
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
                    </div>
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

    <!-- dropzone js -->
    <script src="<?php echo base_url() ?>/assets/admin/libs/dropzone/min/dropzone.min.js"></script>

    <script>
        $('video, audio').mediaelementplayer({
            enableAutosize:true,
            timeFormat:'mm:ss',
            // showTimecodeFrameCount:true,
            autosizeProgress:true,
            alwaysShowControls:true,
            clickToPlayPause:true,
            features: [playpause, current, progress, duration, tracks, volume, fullscreen],
            
        });
    </script>
</body>


<!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Apr 2024 13:51:26 GMT -->

</html>