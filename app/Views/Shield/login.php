<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card row mx-0 flex-row overflow-hidden">
            <div class="col-md-4 bg-size-cover d-flex align-items-center p-4" style="background-image: url('<?php echo base_url() ?>/assets2/admin/images/others/bgx-2.jpg');">
                <div>
                    <div class="mb-5">
                        <div class="logo">
                            <img alt="logo" class="img-fluid" src="<?php echo base_url() ?>/assets/logo/logo.png" style="height: ;">
                        </div>
                    </div>
                    <h3 class="text-white">R MEDIAHUB</h3>
                    <!-- <p class="text-white mt-4 mb-5 o-75">Climb leg rub face on everything give attitude under the bed.</p> -->
                </div>
            </div>
            <div class="col-md-8 px-0">
                <div class="card-body">
                    <div class="my-5 mx-auto" style="max-width: 350px;">
                        <div class="mb-3">
                            <h3>Login</h3>
                        </div>

                        <?php if (session('error') !== null) : ?>
                            <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                        <?php elseif (session('errors') !== null) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php if (is_array(session('errors'))) : ?>
                                    <?php foreach (session('errors') as $error) : ?>
                                        <?= $error ?>
                                        <br>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <?= session('errors') ?>
                                <?php endif ?>
                            </div>
                        <?php endif ?>

                        <form action="<?= url_to('login') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group mb-3">
                                <label class="form-label">Username</label>
                                <input type="email" name="email" class="form-control" value="<?= old('email') ?>" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-flex justify-content-between">
                                    <span>Password</span>
                                </label>
                                <div class="form-group input-affix flex-column">
                                    <label class="d-none">Password</label>
                                    <input class="form-control" type="password" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>">
                                    <i class="suffix-icon feather cursor-pointer text-dark icon-eye" ng-reflect-ng-class="icon-eye"></i>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Log In</button>
                        </form>

                        <br>
                        <br>
                        <br>
                        <br>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>