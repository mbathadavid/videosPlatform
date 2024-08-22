<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="float-start">Media Clips</h5>
        <a href="<?php echo base_url('admin/media_clips/add') ?>" class="btn btn-success text-white float-end">Add Media</a>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <?php
                // echo "<pre>";
                //     print_r($clips);
                // echo "</pre>";
                ?>
                <div class="mt-4">
                    <div class="table-responsive">
                        <table id="data-table" class="table data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Media House</th>
                                    <th>Duration</th>
                                    <th>Slot</th>
                                    <th>Client</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 0;
                                    $tonalities = array(
                                        'Positive' => 'Positive',
                                        'Negative' => 'Negative',
                                        'Neutral' => 'Neutral'
                                    );
                                    foreach ($clips as $cli) {
                                        $c = (object) $cli;
                                        $i++;
                                ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo date('d M Y H:i',$c->datetime) ?></td>
                                        <td><?php echo $c->storytitle ?></td>
                                        <td><?php echo $mediahouses[$c->mediahouse] ?></td>
                                        <td><?php echo $c->duration ?></td>
                                        <td><?php echo $slots[$c->slot] ?></td>
                                        <td><?php echo $clients[$c->client] ?></td>
                                        <td><a href="<?php echo $c->filepath ?>" class="btn btn-sm btn-success" target="_blank">View File</a></td>
                                    </tr>
                                <?php }  ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>