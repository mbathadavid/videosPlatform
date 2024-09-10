<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h4>Clients</h4>
        <div class="row">
            <div class="col-md-3">
                <div class="mt-4">
                    <br>
                    <h5>Add New</h5>

                    <hr>
                    <?php echo form_open(current_url()) ?>

                    <div class="form-group">
                        <label>Name</label>
                        <?php echo form_input('name', '', 'class="form-control" placeholder="Client Name" required') ?>
                    </div>

                    <div class="form-group"  hidden>
                        <label>Email</label>
                        <?php echo form_input('email', '', 'class="form-control" placeholder="Client Email" ') ?>
                    </div>

                    <div class="form-group" hidden>
                        <label>Phone</label>
                        <?php echo form_input('phone', '', 'class="form-control" placeholder="Client Phone Number" ') ?>
                    </div>

                    <div class="form-group">
                        <label>Industry</label>
                        <?php
                        echo form_dropdown('industry', ['' => ''] + $industries, '', 'class="form-select " id="inlineFormSelectPref" placeholder="Client Category" required') ?>
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
            <div class="col-md-9">
                <?php
                // echo "<pre>";
                //     print_r($clients);
                // echo "</pre>";
                ?>
                <div class="mt-4">
                    <div class="table-responsive">
                        <table id="data-table" class="table data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th hidden>Email</th>
                                    <th hidden>Phone</th>
                                    <th>Industry</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($clients) >= 1) {
                                    $i = 0;
                                    foreach ($clients as $cl) {
                                        $i++;
                                ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $cl->name ?></td>
                                            <td hidden><?php echo $cl->email ?></td>
                                            <td hidden><?php echo $cl->phone ?></td>
                                            <td><?php echo $industries[$cl->industry] ?></td>
                                            <td><?php echo $cl->description ?></td>
                                            <td>
                                                <?php
                                                echo $cl->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                                                ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Action <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="<?php echo base_url('admin/clients/edit/' . $cl->id) ?>">Edit</a>
                                                        <?php if ($cl->status == 1) { ?>
                                                        <a class="dropdown-item" href="<?php echo base_url('admin/clients/suspend/' . $cl->id . '/0') ?>">Deactivate</a>
                                                        <?php } else { ?>
                                                        <a class="dropdown-item" href="<?php echo base_url('admin/clients/suspend/' . $cl->id . '/1') ?>">Activate</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="8">No Clients Registered yet</td>
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