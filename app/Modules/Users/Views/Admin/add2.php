<?= $this->extend('layouts/admin/default') ?>


<?= $this->section('content') ?>

<?php
echo form_open(current_url());

// echo "<pre>";
// print_r($perms);
// echo "</pre>";
?>
<div class="row">
    <div class="col-xl-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h6 class="card-title">User Details</h6>
                    </div>
                    <div class="card-body">
                        <p class="fw-semibold mb-2">Email</p>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        <p class="fw-semibold mb-2">Username</p>
                        <input type="text" name="username" class="form-control" id="username" required>
                        <p class="fw-semibold mb-2">Group</p>
                        <?php
                        echo form_dropdown('group', ['' => 'Select Group'] +  $groups,   '', 'class="form-control" data-trigger id="choices-single-default" required')
                        ?>
                        <p class="fw-semibold mb-2">Password</p>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <p class="fw-semibold mb-2">Confirm Password</p>
                        <input type="password" name="cpassword" class="form-control" id="password" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Assign Permissions</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="nav flex-column nav-pills me-3 mb-2" id="vertical-tab" role="tablist" aria-orientation="vertical">
                            <?php
                            $ii = 1;

                            function custom_str_contains($haystack, $needle)
                            {
                                return strpos($haystack, $needle) !== false;
                            }

                            foreach ($perms as $key => $perm) :
                                if ($ii == 1) {
                                    // echo '<li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#' . $key . '" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">' . $key . '</span> </a> </li>';
                                    echo '<button class="nav-link text-start active" id="' . $key . '-tab" data-bs-toggle="pill" data-bs-target="#' . $key . '" type="button" role="tab" aria-controls="vertical-home" aria-selected="true">' . $key . '</button>';
                                } else {
                                    // echo '<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#' . $key . '" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">' . $key . '</span> </a> </li>';
                                    echo '<button class="nav-link text-start" id="' . $key . '-tab" data-bs-toggle="pill" data-bs-target="#' . $key . '" type="button" role="tab" aria-controls="vertical-home" aria-selected="true">' . $key . '</button>';
                                }
                            ?>
                            <?php
                                $ii++;
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content" id="vertical-tabContent">
                            <?php
                            $i = 1;
                            foreach ($perms as $key => $perm) :
                                if ($i == 1) {
                                    echo '<div class="tab-pane fade show active" id="' . $key . '" role="tabpanel" aria-labelledby="' . $key . '-tab" tabindex="0">';
                                } else {
                                    echo '<div class="tab-pane fade" id="' . $key . '" role="tabpanel" aria-labelledby="' . $key . '-tab" tabindex="0">';
                                }

                                foreach ($perm as $kkk => $val) :
                                    if ($val === "index") {
                                        $text = "View " . $key;
                                    } else {
                                        if (custom_str_contains($val, '_')) {
                                            $text = str_replace('_', ' ', $val);
                                        } else {
                                            $text = $val;
                                        }
                                    }
                            ?>
                                    <label>
                                        <input class="form-check-input" type="checkbox" id="<?php echo $key ?>" name="perms[]" value="<?php echo strtolower($key) . '.' . strtolower($val) ?>">
                                        <?php echo ucwords($text) ?> </label><br>
                            <?php
                                endforeach;
                                echo '</div>';
                                $i++;
                            endforeach;
                            ?>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo form_close() ?>

<?= $this->endSection() ?>