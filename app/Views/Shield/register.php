<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card row mx-0 flex-row overflow-hidden">
            <div class="col-md-4 bg-size-cover d-flex align-items-center p-4" style="background-image: url('<?php echo base_url() ?>/assets/admin/images/others/bg-3.jpg');">
                <div>
                    <div class="mb-5">
                        <div class="logo">
                            <img alt="logo" class="img-fluid" src="<?php echo base_url() ?>/assets/admin/images/logo/logo-white.png" style="height: 50px;">
                        </div>
                    </div>
                    <h3 class="text-white">Make your work easier</h3>
                    <p class="text-white mt-4 mb-5 o-75">Climb leg rub face on everything give attitude under the bed.</p>
                </div>
            </div>
            <div class="col-md-8 px-0">
                <div class="card-body">
                    <div class="my-5 mx-auto" style="max-width: 350px;">
                        <div class="mb-3">
                            <h3 class="mb-3">Sign Up</h3>
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
                            <form action="<?= url_to('register') ?>" class="signup-form" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group mb-3">
                                    <label class="form-label">Email</label>
                                    <input
                                        type="email"
                                        class="form-control no-validation-icon no-success-validation"
                                        value="<?= old('email') ?>"
                                        name="email">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Username</label>
                                    <input
                                        type="text"
                                        class="form-control no-validation-icon no-success-validation"
                                        value="<?= old('username') ?>"
                                        name="username">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Phone</label>
                                    <input
                                        type="text"
                                        class="form-control no-validation-icon no-success-validation"
                                        value="<?= old('phone') ?>"
                                        name="phone">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Password</label>
                                    <input
                                        type="password"
                                        class="form-control no-validation-icon no-success-validation"
                                        value="<?= old('password') ?>"
                                        name="password">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input
                                        type="password"
                                        class="form-control no-validation-icon no-success-validation"
                                        value="<?= old('password_confirm') ?>"
                                        name="password_confirm">
                                </div>
                                <button class="btn btn-primary d-block w-100" type="submit">Sign Up</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>