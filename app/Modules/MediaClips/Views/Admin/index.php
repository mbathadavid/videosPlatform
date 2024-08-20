<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="float-start">Media Clips</h5>
        <a href="<?php echo base_url('admin/media_clips/add') ?>" class="btn btn-success text-white float-end">Add Media</a>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10">
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Industry</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>