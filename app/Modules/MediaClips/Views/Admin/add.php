<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="float-start">Media Clips</h5>
        <a href="<?php echo base_url('admin/media_clips') ?>" class="btn btn-success text-white float-end">All Media</a>
    </div>
    <div class="card-body">
        <?php echo form_open(current_url()) ?>
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
                    <input type="text" name="datetime" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
                    <label for="">Attach Files (if any)</label>
                    <input type="file" class="my-pond" name="files[]" />
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="" class="form-label">Sector <span class="text-danger">*</span></label>
                    <input type="text" name="sector" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
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
                <div class="form-group">
                    <label for="" class="form-label">Summary <span class="text-danger">*</span></label>
                    <textarea name="summary" class="form-control" id="" cols="30" rows="3"></textarea>
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                </div>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<?php echo $this->endSection(); ?>