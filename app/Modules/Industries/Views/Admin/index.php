<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>


<div class="card">
    <div class="card-body">
        <h4>Industries</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="mt-4">
                    <br>
                    <h5>Add New</h5>

                    <hr>
                    <?php echo form_open(current_url()) ?>

                    <div class="form-group">
                        <label>Name</label>
                        <?php echo form_input('name', '', 'class="form-control" placeholder="Media Name" required') ?>
                    </div>

                    <br>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <br>


                    <hr>
                    <div class="col-12">
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-primary">Submit</button>
                    </div>

                    <?php echo form_close() ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="mt-4">
                    <div class="table-responsive">
                    <table id="data-table" class="table data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($payload as $p) {
                                $i++;
                            ?>

                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $p->name ?></td>
                                    <td><?php echo $p->description ?></td>
                                    <td><?php echo ($p->status == 1)  ? 'Active' : 'Inactive'; ?></td>
                                    <td><a class="btn btn-sm btn-success" href="<?php echo base_url('admin/industries/' . $p->id . '/update_industry') ?>">Update</a></td>
                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
<?php echo $this->endSection(); ?>