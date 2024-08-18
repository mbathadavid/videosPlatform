<?= $this->extend('layouts/admin/default') ?>


<?= $this->section('content') ?>

<div class="card">
        <div class="card-header">
            <h5 class="float-start">Add User</h5>
            <a href="<?php echo base_url('admin/users') ?>" class="btn btn-success text-white float-end">All Users</a>
        </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-5">
                <?php
                // echo "<pre>";
                //     print_r($theuser);
                // echo "</pre>";
                // die;

                $attributes = [];

                if (session()->has('errors')) {
                    $attributes = ['class' => 'was-validat'];
                }

                echo form_open(current_url(), $attributes);
                ?>
                
                
                <div class="col-12">
                    <label class="fw-semibold mb-2">First Name</label>
                    <input type="text" name="first_name" value="<?= $theuser->first_name ?>" class="form-control <?= validation_show_error('first_name') ? 'is-invalid' : '' ?>" id="first_name">
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('first_name') ?>
                    </div>
                </div>
                <div class="col-12">
                    <label class="fw-semibold mb-2">Last Name</label>
                    <input type="text" name="last_name" value="<?= $theuser->last_name ?>" class="form-control <?= validation_show_error('last_name') ? 'is-invalid' : '' ?>" id="last_name">
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('last_name') ?>
                    </div>
                </div>
                <div class="col-12">
                    <label class="fw-semibold mb-2">Phone</label>
                    <input type="tel" name="phone" value="<?= $theuser->phone ?>" class="form-control <?= validation_show_error('phone') ? 'is-invalid' : '' ?>" id="phone">
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('phone') ?>
                    </div>
                </div>
                <div class="col-12">
                    <label class="fw-semibold mb-2">Email</label>
                    <input type="email" name="email" value="<?= $theuser->secret ?>" class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>" id="email">
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('email') ?>
                    </div>
                </div>
                <div class="col-12">
                    <label class="fw-semibold mb-2">Username</label>
                    <input type="text" name="username" value="<?= $theuser->username ?>" class="form-control <?= validation_show_error('username') ? 'is-invalid' : '' ?>" id="username">
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('username') ?>
                    </div>
                </div>
                <div class="col-12">
                    <label class="fw-semibold mb-2">Group</label>
                    <?php
                    echo form_dropdown('group', ['' => 'Select Group'] +  $groups, $theuser->group, 'class="form-control '. (validation_show_error('group') ? 'is-invalid' : '') . '" data-trigger id="choices-single-default"')
                    ?>
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('group') ?>
                    </div>
                </div>
                <div class="col-12">
                    <label class="fw-semibold mb-2">Password</label>
                    <input type="password" name="password" value="<?= set_value('password') ?>" class="form-control <?= validation_show_error('password') ? 'is-invalid' : '' ?>" id="password">
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('password') ?>
                    </div>
                </div>
                <div class="col-12">
                    <label class="fw-semibold mb-2">Confirm Password</label>
                    <input type="password" name="cpassword" value="<?= set_value('cpassword') ?>" class="form-control <?= validation_show_error('cpassword') ? 'is-invalid' : '' ?>" id="cpassword">
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('cpassword') ?>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>