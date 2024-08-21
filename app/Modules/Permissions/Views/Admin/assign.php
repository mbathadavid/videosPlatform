<?= $this->extend('layouts/admin/default') ?>


<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="float-start">Assign Permissions to group <span class="badge bg-success"><?php echo $group->name; ?></span></h6>
                <a href="<?php echo base_url('admin/permissions') ?>" class="btn btn-success text-white float-end">Permissions</a>
            </div>
            <div class="card-body table-responsive">
                <?php
                // echo "<pre>";
                //         print_r($assigned);
                // echo "</pre>";


                $attributes = [];

                if (session()->has('errors')) {
                    $attributes = ['class' => 'was-validat'];
                }

                echo form_open(current_url(), $attributes);
                ?>
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
                                    } elseif ($val === "*") {
                                        $text = "Manage Everything in ".$key;
                                    } else {
                                        if (custom_str_contains($val, '_')) {
                                            $text = str_replace('_', ' ', $val);
                                        } else {
                                            $text = $val;
                                        }
                                    }

                                    $theperm = strtolower($key) . '.' . strtolower($val);
                            ?>
                                    <label>
                                        <input class="form-check-input" type="checkbox" id="<?php echo $key ?>" name="perms[]" value="<?php echo strtolower($key) . '.' . strtolower($val) ?>" <?php echo in_array($theperm,$assigned) ? "checked" : "" ?>>
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
                <?php echo form_close() ?>
            </div>
        </div>

    </div>
</div>

<script>

</script>
<?= $this->endSection() ?>