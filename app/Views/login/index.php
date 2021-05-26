<?= $this->extend('layout/templateOut'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="mt-5 mb-2">Log In</h1>

      <?php if ($fail) : ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          <i class="bi bi-exclamation-triangle-fill" style="margin-right: 10px;"></i>Wrong username or password!
        </div>
      <?php endif; ?>

      <form action="/login/loginAccount" method="post">
        <?= csrf_field(); ?>

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input name="username" type="text" class="form-control" id="username" placeholder="Username" value="<?= old('username'); ?>" autofocus>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input name="password" type="password" class="form-control" id="password" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Log In</button>

      </form>

      <p class="mt-2">Don't have an account? <a href="/signup">Sign up</a></p>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>