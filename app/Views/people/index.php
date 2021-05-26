<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mb-5">
  <div class="row mt-5">
    <div class="col-2">
      <div class="card">
        <img src="/img/people.jpg" class="card-img-top" alt="..." style="object-fit:cover; height: 100px;">
        <div class="card-body">
          <h1 class="card-title">People</h1>
          <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perspiciatis illum aut voluptatum voluptatibus facilis ex libero quae, velit modi itaque.</p>
        </div>
      </div>
    </div>

    <div class="col-10">
      <div class="row">
        <div class="col">
          <?= $pager->simpleLinks('user', 'people_pagination'); ?>

        </div>

        <div class="col-6 ms-auto">
          <form action="" method="get">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Search People..." name="keyword" value="<?= $keyword; ?>">
              <button class="btn btn-secondary" type="submit" name="submit">Search</button>
            </div>
          </form>

        </div>
      </div>


      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">NIM</th>
            <th scope="col">Batch</th>
            <th scope="col">Department</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>

          <!-- table content -->
          <?php $i = 1 + (25 * ($currentPage - 1)) ?>
          <?php foreach ($user as $u) : ?>
            <tr onclick="window.location='/profile/view/<?= $u['id']; ?>'">
              <th class="align-middle" scope="row"><?= $i++; ?></th>
              <td class="align-middle"><img src="/img/profile/<?= $u['avatar']; ?>" style="width: 30px;
                  height: 30px;
                  background-position: center center;
                  background-repeat: no-repeat;
                  object-fit:cover;">
              </td>
              <td class="align-middle"><?= $u['name']; ?></td>
              <td class="align-middle"><?= $u['nim']; ?></td>
              <td class="align-middle"><?= $u['batch']; ?></td>
              <td class="align-middle"><?= $u['department']; ?></td>
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