<?= $this->extend('layouts/admin/default') ?>


<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="float-start">All User Groups</h5>
                <!-- <a href="<?php echo base_url('admin/users/add') ?>" class="btn btn-success text-white float-end">Add User</a> -->
            </div>
            <div class="card-body table-responsive">
                <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap responsive-datatable datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Group</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($groups as $key => $group) {
                            $g = (object) $group;
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $g->name; ?></td>
                                <td><?php echo $g->title; ?></td>
                                <td><?php echo $g->description; ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <!-- <a class="dropdown-item" href="<?php echo base_url('admin/permissions/assign_modules/' . $g->id) ?>">Assign Modules</a> -->
                                            <a class="dropdown-item" href="<?php echo base_url('admin/permissions/assign/' . $g->id) ?>">Assign Permissions</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>

</script>
<?= $this->endSection() ?>