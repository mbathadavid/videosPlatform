<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="float-start">Media Clips</h5>
        <a href="<?php echo base_url('admin/media_clips') ?>" class="btn btn-success text-white float-end">All Media</a>
    </div>
    <div class="card-body">
        <?php echo form_open_multipart(current_url()) ?>
        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Story Title <span class="text-danger">*</span></label>
                    <input type="text" name="storytitle" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label>Media House <span class="text-danger">*</span></label>
                    <?php
                    echo form_dropdown('mediahouse', ['' => 'Select Media'] + $mediahouses, '', 'class="form-select " id="inlineFormSelectPref" placeholder="Media House" required')
                    ?>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Date & Time <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="datetime" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label>Slot <span class="text-danger">*</span></label>
                    <?php
                    echo form_dropdown('slot', ['' => 'Select Slot'] + $slots, '', 'class="form-select " id="inlineFormSelectPref" placeholder="Slot" required')
                    ?>
                </div>
                <div class="form-group">
                    <label>Client <span class="text-danger">*</span></label>
                    <?php
                    echo form_dropdown('client', ['' => 'Select Client'] + $clients, '', 'class="form-select " id="inlineFormSelectPref" placeholder="Slot" required')
                    ?>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Sector <span class="text-danger">*</span></label>
                    <input type="text" name="sector" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
            </div>

            <div class="col-md-6 col-lg-6">

                <div class="form-group">
                    <label for="" class="form-label">Duration <span class="text-danger">*</span></label>
                    <input type="text" name="duration" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label>Tonality <span class="text-danger">*</span></label>
                    <?php
                    $tonalities = array(
                        'Positive' => 'Positive',
                        'Negative' => 'Negative',
                        'Neutral' => 'Neutral'
                    );

                    echo form_dropdown('tonality', ['' => 'Select Tonality'] + $tonalities, '', 'class="form-select " id="inlineFormSelectPref" placeholder="Slot" required')
                    ?>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Journalist <span class="text-danger"></span></label>
                    <input type="text" name="journalist" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Summary <span class="text-danger">*</span></label>
                    <textarea name="summary" class="form-control" id="" cols="30" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="">Attach Files</label>
                    <input type="file" class="" name="filepond" accept=".mp3,.mp4" />
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                </div>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>

<script>
    // $(function() {

    //     // First register any plugins
    //     $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

    //     // Turn input element into a pond
    //     $('.my-pond').filepond();

    //     //Limit Files Selected
    //     $('.my-pond').filepond({
    //         // acceptedFileTypes: ['image/*', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/pdf', 'application/zip', 'application/x-zip-compressed', 'multipart/x-zip'], // Specify the allowed file types
    //         acceptedFileTypes: ['video/mp4', 'audio/mp3'],
    //         maxFileSize: '20MB', // Specify the maximum file size
    //         name: 'images[]'
    //     });

    //     // Set allowMultiple property to true
    //     $('.my-pond').filepond('allowMultiple', true);

    //     // Listen for addfile event
    //     $('.my-pond').on('FilePond:addfile', function(e) {
    //         console.log('file added event', e);
    //     });

    // });
</script>
<script>
    $(document).ready(function() {
        // $('.filepond--browser').attr('accept', '.mp3,.mp4');

        $('.my-pond').filepond({
            acceptedFileTypes: ['video/mp4'],
            maxFileSize: '20MB',
            // allowMultiple: true,
            name: 'filepond'
        });

        // Listen for the addfile event
        $('.my-pond').on('FilePond:addfile', function(e) {
            console.log('file added event', e);
        });

        // $('.filepond--browser').attr('accept', '.mp3,.mp4');

        // $('.my-pond').filepond({
        //     allowMultiple: false,
        //     credits: false,
        //     checkValidity: true,
        //     allowProcess: true,
        //     stylePanelLayout: 'compact',
        //     acceptedFileTypes: ['video/mp4', 'audio/mp3'],
        //     name: 'filepond',
        //     // labelIdle: '<p>Please upload admission documents </p> <span class="filepond--label-action" style="font-size: 150px"><i class="icomg-folder"></i></span>',
        //     onprocessfiles: (e) => {
        //         () => console.log('Done')
        //     },
        //     server: {
        //         url: '<?php echo base_url() ?>',

        //         process: {
        //             url: 'admin/media_clips/upload',
        //             method: 'POST',
        //             instantUpload: false,
        //             withCredentials: false,
        //             headers: {},
        //             timeout: 7000,
        //             onload: (response) => {
        //                 console.log(response);
        //                 // window.location = '<?php echo base_url('admin/media_clips') ?>';
        //             },
        //             onerror: null,
        //             data: {
        //                 student: $('#pond_std').val()
        //             },

        //             ondata: (formData) => {
        //                 // if ($('#pond_std').val()) {
        //                 //     formData.append('student', $('#pond_std').val());

        //                 //     return formData;
        //                 // } else {
        //                 //     $('#pond_err').html(`No student Selected`);
        //                 //     return false;
        //                 // }

        //             }
        //         },


        //     }
        // });
    });
</script>
<?php echo $this->endSection(); ?>