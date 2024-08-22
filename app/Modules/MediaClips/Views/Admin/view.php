<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="float-start">Media Clips</h5>
        <a href="<?php echo base_url('admin/media_clips') ?>" class="btn btn-success text-white float-end">All Media</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <?php 
                if (count($clips) > 0) {
                   foreach ($clips as $key => $cli) {
                    $cli = (object) $cli;  
                    $filepath = $cli->path;
                    $mimeType = mime_content_type($filepath);

                    // print_r($mimeType);
                ?>

                <video id="player1" width="100%" height="<?php echo $mimeType === "audio/mpeg" ? '100px' : 'auto' ?>" controls>
                    <source src="<?php echo base_url($cli->path) ?>" type="video/mp4">
                </video>
                <?php } } else {  ?>
                        <h5 class="text-center">There are no media files found</h5>
                <?php }  ?>

                <!-- <div class="table-responsive">
                    <table class="table">
                        <thead class="">
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" style="border-bottom: 0;" class="text-center"><b>Summary</b></td>
                            </tr>
                            <tr class="bg-grey">
                                <td style="border-top: 0;" colspan="2"><?php echo $clip->summary ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
            </div>
            <div class="col-lg-6 col-md-6">
                <?php
                // echo "<pre>";
                // print_r($clip);
                // echo "</pre>";
                $tonalities = array(
                    'Positive' => 'Positive',
                    'Negative' => 'Negative',
                    'Neutral' => 'Neutral'
                );
                ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <th colspan="2" class="text-center">Clip Details</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Title</b></td>
                                <td><?php echo $clip->storytitle ?></td>
                            </tr>
                            <tr>
                                <td><b>Media House</b></td>
                                <td><?php echo $mediahouses[$clip->mediahouse] ?></td>
                            </tr>
                            <tr>
                                <td><b>Rate Card</b></td>
                                <td><?php echo $clip->ratecard ?></td>
                            </tr>
                            <tr>
                                <td><b>Date & Time</b></td>
                                <td><?php echo date('d M Y H:i',$clip->datetime) ?></td>
                            </tr>
                            <tr>
                                <td><b>Slot</b></td>
                                <td><?php echo $slots[$clip->slot] ?></td>
                            </tr>
                            <tr>
                                <td><b>Client</b></td>
                                <td><?php echo $clients[$clip->client] ?></td>
                            </tr>
                            <tr>
                                <td><b>Sector</b></td>
                                <td><?php echo $clip->sector ?></td>
                            </tr>
                            <tr>
                                <td><b>Duration</b></td>
                                <td><?php echo $clip->duration ?></td>
                            </tr>
                            <tr>
                                <td><b>Tonality</b></td>
                                <td><?php echo $tonalities[$clip->tonality] ?></td>
                            </tr>
                            <tr>
                                <td><b>Journalist</b></td>
                                <td><?php echo $clip->journalist ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-bottom: 0;" class="text-center"><b>Summary</b></td>
                            </tr>
                            <tr class="bg-grey">
                                <td style="border-top: 0;" colspan="2"><?php echo $clip->summary ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>