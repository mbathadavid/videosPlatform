<?= $this->extend('layouts/admin/default') ?>


<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?php echo base_url('admin/users/add') ?>" class="btn btn-success text-white float-end">Add User</a>
            </div>
            <?php
            if (count($admins) > 0) {
            ?>
                <div class="card-body table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap responsive-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Group</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($admins as $ad) {
                                $i++;

                                // echo "<pre>";
                                //     print_r($ad);
                                // echo "</pre>";
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $ad->first_name ?></td>
                                <td><?php echo $ad->last_name ?></td>
                                <td><?php echo $ad->phone ?></td>
                                <td><?php echo $ad->secret; ?></td>
                                <td><?php echo $ad->username; ?></td>
                                <td>
                                    <?php
                                    echo ucwords($ad->group);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $ad->active == 1 ? '<span class="badge rounded-pill bg-success">Active</span>' : '<span class="badge rounded-pill bg-danger">Inactive</span>';
                                    ?>
                                </td>
                                <td></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <h6 class="text-center">No Users Registered at the moment</h6>
            <?php } ?>
        </div>

    </div>
</div>

<?= $this->endSection() ?>