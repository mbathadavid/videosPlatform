<?= $this->extend('layouts/admin/default') ?>


<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4 col-lg-4 col-xl-4">
        <!-- Group Register Form Start -->
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Register Group
                </div>
            </div>
            <div class="card-body">
                <?php echo form_open(current_url()) ?>
                <div class="mb-2">
                    <label for="exampleInputEmail1" class="form-label">Group Name</label>
                    <input type="text" name="group" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-2">
                    <label for="title" class="form-label">Group Title</label>
                    <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
                </div>
                <div class="mb-2">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <!-- Group Register Form End -->
    <div class="col-md-8 col-lg-8 col-xl-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registered Groups</h3>
            </div>
            <div class="card-body">
                <?php 
                    if (count($groups) > 0) {
                ?>
                <div class="table-responsive">
                    <table class="table border text-nowrap text-md-nowrap table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
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
                                <td></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
                    <h6 class="text-center">No Groups Registered yet</h6>
                <?php } ?>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>