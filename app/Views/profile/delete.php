<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="mt-5 mb-2">Setting</h1>

      <!-- setting navbar -->
      <?= $this->include('layout/navbarSetting'); ?>

      <h2 class="mb-5 mt-3">Delete</h2>

      <h4 class="mt-3">Delete your accout.</h4>

      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccount">
        Delete Account
      </button>
      <!-- <a class="btn btn-danger" href="/profile/deleteAccount/<?= $user['id']; ?>">Delete</a> -->

    </div>
  </div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="deleteAccount" tabindex="-1" aria-labelledby="deleteAccountLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteAccountLabel">Delete Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to terminate your account? It will be lost forever...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="/profile/deleteAccount/<?= $user['id']; ?>">Delete</a>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>