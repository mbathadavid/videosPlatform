<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>


<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4>Industries</h4>

                <div class="mt-6">


                    <hr>
                    <?php echo form_open(current_url()) ?>

                    <div class="form-group">
                        <label>Name</label>
                        <?php echo form_input('name', $row->name, 'class="form-control" placeholder="Media Name" required') ?>
                    </div>

                    <br>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control"><?php echo $row->description?></textarea>
                        
                    </div>


                    <hr>
                    <div class="col-12">
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-primary btn-sm">Submit</button>
                        <a type="submit" class="btn btn-danger btn-sm" onclick="window.history.back()">Cancel</a>
                    </div>

                    <?php echo form_close() ?>
                </div>





            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>