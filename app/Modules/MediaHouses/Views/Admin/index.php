<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>


<div class="card">
    <div class="card-body">
        <h4>Media Houses</h4>
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
                        <label>Category</label>
                        <?php
                        $cats =  ['Radio' => 'Radio', 'TV' => 'TV', 'Print' => 'Print'];
                        echo form_dropdown('category', ['' => ''] + $cats, '', 'class="form-select " id="inlineFormSelectPref" placeholder="Media Name" required') ?>
                    </div>

                    <br>

                    <div class="form-group">
                        <label>Rate Card</label>
                        <?php echo form_input('rate_card', '', 'class="form-control" placeholder="Rate Card" required') ?>
                    </div>

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
                                    <th>Category</th>
                                    <th>Rate Card</th>
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
                                        <td><?php echo $p->category ?></td>
                                        <td><?php echo $p->rate_card ?></td>
                                        <td><a class="btn btn-sm btn-success" href="<?php echo base_url('admin/media-houses/' . $p->id . '/update_media') ?>">Update</a></td>
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