<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>


<div class="card">
    <div class="card-body">
        <h4>Industries</h4>

        <div class="mt-8">


            <hr>
            <?php echo form_open(current_url()) ?>

            <div class="form-group">
                <label>Name</label>
                <?php echo form_input('name', $row->name, 'class="form-control" placeholder="Media Name" required') ?>
            </div>

            <br>
            <div class="form-group">
                <label>Status</label>
                <?php
                $stat =  [1 => 'Active', 2 => 'Inactive'];
                echo form_dropdown('status', ['' => ''] + $stat, $row->status, 'class="form-select " id="inlineFormSelectPref" placeholder="Status" required') ?>
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
<?php echo $this->endSection(); ?>