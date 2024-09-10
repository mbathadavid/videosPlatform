<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="float-start">Media Clips</h5>
        <a href="<?php echo base_url('admin/media_clips') ?>" class="btn btn-success text-white float-end">All Media</a>
    </div>
    <div class="card-body">
        <?php
        $attributes = [];

        echo form_open_multipart(current_url(), $attributes)
        ?>
        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    <label>Category <span class="text-danger">*</span></label>
                    <?php
                    $cats = array(
                        1 => 'Print Media',
                        2 => 'Media Clips'
                    );
                    echo form_dropdown('category', ['' => 'Select Category'] + $cats, '', 'class="form-select " id="category" placeholder="Category" required')
                    ?>
                </div>
                <div id="publicationfields">
                    <div class="form-group">
                        <label for="" class="form-label">Page <span class="text-danger"></span></label>
                        <input type="text" name="page" class="form-control" id="page" aria-describedby="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">SOI(cm<sup>2</sup>) <span class="text-danger"></span></label>
                        <input type="text" name="soi" class="form-control" id="soi" aria-describedby="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Story Title <span class="text-danger">*</span></label>
                    <input type="text" name="storytitle" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                <div class="form-group clipmedia ">
                    <label>Media House <span class="text-danger">*</span></label>
                    <?php
                    echo form_dropdown('mediahouse', ['' => 'Media House'] + $mediahouses, '', 'class="form-select " id="xx" placeholder="Media House" ')
                    ?>

                </div>

                <div class="form-group printmedia " style="display: none;">
                    <label>Print Media <span class="text-danger">*</span></label>
                    <?php
                    echo form_dropdown('mediahouse', ['' => 'Print Media'] + $print_media, '', 'class="xsel" id="x1" placeholder="Print Media" ')
                    ?>
                </div>


                <div class="form-group">
                    <label for="" class="form-label">Date & Time <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="datetime" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label>Slot <span class="text-danger">*</span></label>
                    <?php
                    echo form_dropdown('slot', ['' => 'Select Slot'] + $slots, '', 'class="form-select " id="" placeholder="Slot" required')
                    ?>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Summary <span class="text-danger">*</span></label>
                    <textarea name="summary" class="form-control" id="" cols="30" rows="9"></textarea>
                </div>
                <!-- <div class="form-group">
                    <label for="" class="form-label">Sector <span class="text-danger">*</span></label>
                    <input type="text" name="sector" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div> -->
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="form-group mb-2">
                    <label>Client <span class="text-danger">*</span></label>
                    <?php
                    echo form_dropdown('client', ['' => 'Select Client'] + $clients, '', 'class="form-select " id="" placeholder="Slot" required')
                    ?>
                </div>
                <div class="form-group mediafields">
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
                <div class="form-group mb-2">
                    <label for="" class="form-label">Journalist <span class="text-danger"></span></label>
                    <input type="text" name="journalist" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>


                <div class="form-group">
                    <!-- <label for="">Attach Files</label>
                    <input type="file" class="form-control" name="filepond" accept=".mp3,.mp4" /> -->
                    <!-- Dropzone file input -->
                    <div class="dropzone" id="myDropzone">
                        <div class="dz-message">Drag & drop your image or click to select</div>
                    </div>
                    <input type="file" name="filepond[]" id="fileInput" accept=".mp4,.mp3,image/*,.pdf" style="display: none;" multiple>

                </div>


            </div>
        </div>
        <div class="form-group mt-2">
            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>


<script>
    Dropzone.autoDiscover = false;

    // Initialize Dropzone
    var myDropzone = new Dropzone("#myDropzone", {
        url: "/", // Dummy URL since we're not actually uploading
        autoProcessQueue: false,
        uploadMultiple: true,
        maxFilesize: 20000,
        acceptedFiles: "video/mp4,audio/mpeg,image/*",
        addRemoveLinks: true,

        init: function() {
            var dropzoneInstance = this;

            // Trigger file input click on Dropzone click
            this.element.addEventListener("pointerdown", function(event) {
                if (!this.classList.contains('dropzone-disabled')) {
                    // Add a class to disable further clicks temporarily
                    this.classList.add('dropzone-disabled');
                    document.getElementById("fileInput").click();
                }
            });

            // Handle file input change
            document.getElementById("fileInput").addEventListener("change", function(event) {
                var files = event.target.files;

                // Add each selected file to Dropzone
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    dropzoneInstance.addFile(file); // Adds file to Dropzone for previewing
                }

                // Remove the class to re-enable Dropzone clicking
                dropzoneInstance.element.classList.remove('dropzone-disabled');
            });

            // Remove file from the input when removed from Dropzone
            this.on("removedfile", function() {
                document.getElementById("fileInput").value = "";
            });
        }
    });
</script>
<script>
    $(document).ready(function() {
        $("#publicationfields").hide();
        // $('.printmedia').hide();

        $("#category").change(function() {
            var cat = $(this).val();

            if (cat == 1) {
                $("#publicationfields").show();
                $('.mediafields').hide();
                $('.clipmedia').hide('slow');
                $('.printmedia').show('slow');

                $('.xsel').select2({
                    width: '100%' // You can set the width here
                });

                $('#xx').val(null).trigger('change');
            } else if (cat == 2) {
                $("#publicationfields").hide();

                $('.clipmedia').show('slow');
                $('.mediafields').show();
                $('.printmedia').hide('slow');
                $('#x1').val(null).trigger('change');
            }
            // console.log(cat);
        });
    });
</script>


<?php echo $this->endSection(); ?>