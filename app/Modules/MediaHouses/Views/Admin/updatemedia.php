<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>


<div class="card">
    <div class="card-body">
        <h4>Media Houses</h4>
        
                <div class="mt-8">
                    

                    <hr>
                    <?php echo form_open(current_url()) ?>

                    <div class="form-group">
                        <label>Name</label>
                        <?php echo form_input('name', $row->name, 'class="form-control" placeholder="Media Name" required') ?>
                    </div>

                    <br>
                    <div class="form-group">
                        <label>Category</label>
                        <?php
                        $cats =  ['Radio' => 'Radio', 'TV' => 'TV'];
                        echo form_dropdown('category', ['' => ''] + $cats, $row->category, 'class="form-select " id="inlineFormSelectPref" placeholder="Media Name" required') ?>
                    </div>

                    <br>

                    <div class="form-group">
                        <label>Rate Card</label>
                        <?php echo form_input('rate_card', $row->rate_card, 'class="form-control" placeholder="Rate Card" required') ?>
                    </div>

                    <hr>
                    <div class="col-12">
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-primary">Submit</button>
                    </div>

                    <?php echo form_close() ?>
                </div>
           




    </div>
</div>
<?php echo $this->endSection(); ?>