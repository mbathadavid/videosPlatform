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

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/filepond/filepond.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/filepond/filepond-plugin-image-preview.min.css">
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
    <!-- include FilePond library -->
    <script src="<?php echo base_url() ?>assets/admin/js/filepond/filepond.min.js"></script>

    <!-- include FilePond plugins -->
    <script src="<?php echo base_url() ?>assets/admin/js/filepond/filepond-plugin-image-preview.min.js"></script>

    <!-- include FilePond jQuery adapter -->
    <script src="<?php echo base_url() ?>assets/admin/js/filepond/filepond.jquery.js"></script>
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
    </script>

    <script>
        $(function() {

            // First register any plugins
            $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

            // Turn input element into a pond
            $('.my-pond').filepond();

            //Limit Files Selected
            $('.my-pond').filepond({
                // acceptedFileTypes: ['image/*', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/pdf', 'application/zip', 'application/x-zip-compressed', 'multipart/x-zip'], // Specify the allowed file types
                acceptedFileTypes: ['video/mp4', 'audio/mpeg'],
                // maxFileSize: '20MB', // Specify the maximum file size
                name: 'files[]'
            });

            // Set allowMultiple property to true
            $('.my-pond').filepond('allowMultiple', true);

            // Listen for addfile event
            $('.my-pond').on('FilePond:addfile', function(e) {
                console.log('file added event', e);
            });

            // Manually add a file using the addfile method
            // $('.my-pond').first().filepond('addFile', 'index.html').then(function(file){
            //   console.log('file added', file);
            // });

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