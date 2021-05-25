<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="mt-5 mb-2">Setting</h1>

      <!-- setting navbar -->
      <?= $this->include('layout/navbarSetting'); ?>

      <h2 class="mb-5 mt-3">Account Setting</h2>

      <form action="/profile/editData/<?= $user['id']; ?>" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="id" value="<?= $user['id']; ?>">
        <input type="hidden" name="hiddenDept" value="<?= $user['department'] ?>">

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="<?= $user['name'] ?>">

        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="<?= $user['email'] ?>">
        </div>

        <button type="submit" class="btn btn-primary">Save Change</button>

      </form>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>