<?= $this->extend('layouts/admin/default') ?>


<?= $this->section('content') ?>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Clients</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="<?php echo $clients ?>">0</span>
                        </h4>
                    </div>

                    <div class="col-6">
                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="badge bg-success-subtle text-success">+<?php echo $clients_w ?></span>
                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Clips</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="<?php echo $clips ?>">0</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="badge bg-success-subtle text-success">+<?php echo $clips_w ?></span>
                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col-->

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Industries</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="<?php echo $industries ?>">0</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="badge bg-success-subtle text-success">+ <?php echo $industries_w ?></span>
                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Media Houses</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="<?php echo $media ?>">0</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="badge bg-success-subtle text-success">+<?php echo $media_w ?></span>
                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row-->



<!-- end row-->

<div class="row">


    <div class="col-xl-8">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Recent Clips</h4>
                <div class="flex-shrink-0">

                    <!-- end nav tabs -->
                </div>
            </div><!-- end card header -->

            <div class="card-body px-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                        <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                            <table class="table align-middle table-nowrap table-borderless">
                                <tbody>

                                    <?php
                                    foreach ($recent_clips as $p) {
                                    ?>
                                        <tr>


                                            <td>
                                                <div>
                                                    <h5 class="font-size-14 mb-1">Date</h5>
                                                    <p class="text-muted mb-0 font-size-12"><?php echo date('d M, Y', $p->datetime) ?>1</p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="">
                                                    <h5 class="font-size-14 mb-0">Client</h5>
                                                    <p class="text-muted mb-0 font-size-12"><?php echo isset($Clientss[$p->client]) ? $Clientss[$p->client]  : '' ?> </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="text-end">
                                                    <h5 class="font-size-14 text-muted mb-0">Title</h5>
                                                    <p class="text-muted mb-0 font-size-12"><?php echo $p->storytitle ?></p>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end tab pane -->

                    <!-- end tab pane -->
                </div>
                <!-- end tab content -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xl-4">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Recent Clients</h4>
                <div class="flex-shrink-0">

                </div>
            </div><!-- end card header -->

            <div class="card-body px-0">
                <div class="px-3" data-simplebar style="max-height: 352px;">
                    <ul class="list-unstyled activity-wid mb-0">

                        <?php
                        foreach ($recent_clients as $p) {
                        ?>
                            <li class="activity-list activity-border">
                                <div class="activity-icon avatar-md">
                                    <span class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                        <i class="bx bx-file font-size-24"></i>
                                    </span>
                                </div>
                                <div class="timeline-list-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 overflow-hidden me-4">
                                            <h5 class="font-size-14 mb-1"><?php echo date('d/m/Y, H:m:s')?></h5>
                                            <p class="text-truncate text-muted font-size-13">
                                                <?php echo isset($Industries[$p->industry]) ? $Industries[$p->industry] : ''  ?></p>
                                        </div>
                                        <div class="flex-shrink-0 text-end me-3">
                                            <h6 class="mb-1"><?php echo $p->name?></h6>
                                            <div class="font-size-13"></div>
                                        </div>

                                        
                                    </div>
                                </div>
                            </li>

                        <?php } ?>

                    </ul>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div><!-- end row -->
<?= $this->endSection() ?>