<?= $this->extend('layouts/admin/default') ?>


<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="float-start">All Users</h5>
                <a href="<?php echo base_url('admin/users/add') ?>" class="btn btn-success text-white float-end">Add User</a>
            </div>
            <?php
            if (count($admins) > 0) {
            ?>
                <div class="card-body table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap responsive-datatable datatable">
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

                                $users = auth()->getProvider();

                                $user = $users->findById($ad->id);
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
                                        echo !$user->isBanned() ? '<span class="badge rounded-pill bg-success">Active</span>' : '<span class="badge rounded-pill bg-danger">Banned</span>';
                                        ?>
                                    </td>
                                    <td>
                                        <button id="btnGroupDrop1" type="button" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <li><a class="dropdown-item" href="<?php echo base_url('admin/users/edit/'.$ad->id) ?>">Edit</a></li>
                                            <?php if ($user->isBanned()) { ?>
                                                <li><a class="dropdown-item" href="<?php echo base_url('admin/users/unban/'.$ad->id) ?>">Unban</a></li>
                                            <?php } else { ?>
                                                <li><a class="dropdown-item" href="<?php echo base_url('admin/users/ban/'.$ad->id) ?>">Ban</a></li>
                                            <?php } ?>
                                            <li><a class="dropdown-item" href="<?php echo base_url('admin/users/suspend/'.$ad->id.'/0') ?>">Suspend</a></li>
                                        </ul>
                                    </td>
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