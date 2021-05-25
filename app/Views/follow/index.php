<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mb-5">
  <div class="row mt-5">
    <div class="col-2">
      <div class="card">
        <img src="/img/people.jpg" class="card-img-top" alt="..." style="object-fit:cover; height: 100px;">
        <div class="card-body">
          <h1 class="card-title">Follow</h1>
          <!-- <p class="card-text"></p> -->
        </div>
        <ul class="list-group list-group-flush">
          <a href="/follow">
            <li class="list-group-item active">Following</li>
          </a>
          <a href="/follow/follower">
            <li class="list-group-item">Follower</li>
          </a>

        </ul>
      </div>
    </div>
    <div class="col-10">

      <h1>Following</h1>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>

          <!-- table content -->
          <?php $i = 1 ?>
          <?php foreach ($following as $u) : ?>
            <tr onclick="window.location='/profile/view/<?= $u['id']; ?>'">
              <th class="align-middle" scope="row"><?= $i++; ?></th>
              <td class="align-middle"><img src="/img/profile/<?= $u['avatar']; ?>" style="width: 30px;
                  height: 30px;
                  background-position: center center;
                  background-repeat: no-repeat;
                  object-fit:cover;">
              </td>
              <td class="align-middle"><?= $u['name']; ?></td>

              <td class="align-middle">
                <?php if ($u['availability'] == 'Available') : ?>
                  <p class="badge bg-success"><?= $u['availability']; ?></p>
                <?php elseif (($u['availability'] == 'Unavailable')) : ?>
                  <p class="badge bg-danger"><?= $u['availability']; ?></p>
                <?php elseif (($u['availability'] == 'Do Not Disturb')) : ?>
                  <p class="badge bg-warning"><?= $u['availability']; ?></p>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
          </tr>
        </tbody>
      </table>



    </div>
  </div>
</div>

<?= $this->endSection(); ?>