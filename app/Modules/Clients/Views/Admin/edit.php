<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="float-start">Clients</h5>
        <a href="<?php echo base_url('admin/clients') ?>" class="btn btn-success text-white float-end">All Clients</a>
    </div>
    <div class="card-body">

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 col-sm-10">
                <div class="mt-4">
                    <!-- <br> -->
                    <h5>Edit Client</h5>

                    <hr>
                    <?php 
                        echo form_open(current_url());
                    ?>
                    <input type="number" value="<?php echo $client->user_id ?>" name="userid" id="userid" hidden>
                    <div class="form-group">
                        <label>Name</label>
                        <?php echo form_input('name', $client->name, 'class="form-control" placeholder="Client Name" required') ?>
                    </div>

                     

                    <div class="form-group">
                        <label>Industry</label>
                        <?php
                        echo form_dropdown('industry', ['' => ''] + $industries, $client->industry, 'class="form-select " id="inlineFormSelectPref" placeholder="Client Category" required') ?>
                    </div>

                    <br>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control"><?php echo $client->description ?></textarea>
                    </div>

                    <br>


                    <hr>
                    <div class="col-12">
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-primary">Submit</button>
                    </div>

                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>