<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="mx-auto col-md-6">
        <div class="card p-3 bg-light">
            <?php flash('register_success') ?>
            <h2>Login to share posts</h2>
        <p class='mt-3'>Login</p>
        <form action="<?php echo URLROOT?>/users/login" method="post" enctype="multipart/form-data">
            <div class="from-group">
                <label for="email">Email: <sup>*</sup></label>
                <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
            </div>
            <div class="from-group">
                <label for="password">Password: <sup>*</sup></label>
                <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
            <div class="row mt-3">
                <div class="col">
                    <input type="submit" value="Login" class='btn btn-success btn-block'>
                </div>
                <div class="col">
                    <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block">Don't have an account? Register</a>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>