<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="float-start">Settings</h5>
    </div>
    <div class="card-body">
        <div class="row justify-content-">
            <div class="col-lg-6 col-md-6">
                <?php
                 

                $attributes = [];

                if (session()->has('errors')) {
                    $attributes = ['class' => 'was-validat'];
                }

                echo form_open_multipart(current_url(), $attributes);
                ?>


                <div class="col-12">
                    <label class="fw-semibold mb-2">Name</label>
                    <input type="text" name="name" value="<?= $settings->name ?>" class="form-control <?= validation_show_error('name') ? 'is-invalid' : '' ?>" id="first_name">
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('name') ?>
                    </div>
                </div>
                <div class="col-12">
                    <label class="fw-semibold mb-2">Short Name</label>
                    <input type="text" name="shortname" value="<?= $settings->shortname ?>" class="form-control <?= validation_show_error('shortname') ? 'is-invalid' : '' ?>" id="last_name">
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('shortname') ?>
                    </div>
                </div>
                <div class="col-12">
                    <label class="fw-semibold mb-2">Email Address</label>
                    <input type="text" name="email" value="<?= $settings->email ?>" class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>" id="last_name">
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('address') ?>
                    </div>
                </div>
                <div class="col-12 mb-2">
                    <label class="fw-semibold mb-2">Phone</label>
                    <input type="tel" name="phone" value="<?= $settings->phone ?>" class="form-control <?= validation_show_error('phone') ? 'is-invalid' : '' ?>" id="phone">
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('phone') ?>
                    </div>
                </div>
                <div class="col-12">

                </div>
                <div class="col-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <img src="<?php echo base_url($settings->logopath) ?>" alt="" class="img-fluid">
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="dropzone" id="myDropzone">
                                    <div class="dz-message">Drag & drop your image or click to select</div>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="filepond" id="fileInput" accept="images/*" style="display: none;">
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
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
        acceptedFiles: "images/*",
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
<?php echo $this->endSection(); ?>