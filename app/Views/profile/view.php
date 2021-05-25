<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container mb-5">
  <img class="" width="200px" src="/img/header/<?= $user['header']; ?>" alt="" style="object-fit:cover; width: 100%; height: 200px;">
  <div class="row mt-5 mb-2">
    <div class="col-9">

      <h1 class="">Profile <?= $user['name']; ?></h1>

      <?php if ($user['availability'] == 'Available') : ?>
        <p class="badge bg-success"><?= $user['availability']; ?></p>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#message">
          Message
        </button>
      <?php elseif (($user['availability'] == 'Unavailable')) : ?>
        <p class="badge bg-danger"><?= $user['availability']; ?></p>
      <?php elseif (($user['availability'] == 'Do Not Disturb')) : ?>
        <p class="badge bg-warning"><?= $user['availability']; ?></p>
      <?php endif; ?>

      <?php if ($user['cv'] != '') : ?>
        <a class="btn btn-success" href="/docs/cv/<?= $user['cv'] ?>" target="_blank">CV</a>
      <?php endif; ?>

      <?php if(!$follow): ?>
          <a class="btn btn-success" href="/profile/follow/<?= $user['id']; ?>">Follow</a>
      <?php else: ?>
          <a class="btn btn-success" href="/profile/unfollow/<?= $user['id']; ?>">Unfollow</a>
      <?php endif; ?>


      <br>

      <img class="mb-3 rounded-circle" width="200px" src="/img/profile/<?= $user['avatar']; ?>" alt="" style="  width: 100px;
        height: 100px;
        background-position: center center;
        background-repeat: no-repeat;
        object-fit:cover;">

      <h2>Information</h2>

      <ul>
        <li>Name : <?= $user['name']; ?></li>
        <li>Username : <?= $user['username']; ?></li>
        <li>Email : <?= $user['email']; ?></li>
        <li>Department : <?= $user['department']; ?></li>
      </ul>

      <h2>About Me</h2>

      <ul>
        <li>About Me : <?= $general['about_me']; ?></li>
        <li>Phone : <?= $general['phone']; ?></li>
        <li>Profession : <?= $general['profession']; ?></li>
        <li>Experience : <?= $general['experience']; ?></li>
      </ul>

      <h2>Skill</h2>

      <table class="table">
        <thead>
          <tr class="">
            <!-- <th class="col-md-1" scope="col">#</th> -->
            <th class="col-md-1" scope="col">Skill</th>
            <th class="col-md-3" scope="col">Level</th>
            <th class="col-md-2" scope="col">Description</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 ?>
          <?php foreach ($skill as $s) : ?>
            <tr>
              <!-- <th scope="row"><?= $i++; ?></th> -->
              <td><?= $s['name']; ?></td>
              <td class="">
                <div class="progress">
                  <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="<?= $s['level']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $s['level'] * 10; ?>%">
                    <b><?= $s['level']; ?></b>
                  </div>
                </div>
              </td>
              <td><?= $s['description']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>


      <!-- <?php foreach ($skill as $s) : ?>
        <ol class="list-group" data-bs-toggle="collapse" data-bs-target="#collapse<?= $s['skill_id']; ?>" aria-expanded="false" aria-controls="collapseExample">
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="">
              <div class="fw-bold"><?= $s['name']; ?></div>

              <div class="collapse" id="collapse<?= $s['skill_id']; ?>">
                <?= $s['description']; ?>
              </div>

            </div>
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="<?= $s['level']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $s['level'] * 10; ?>%">
                <?= $s['level']; ?>
              </div>
            </div>
          </li>
        </ol>
      <?php endforeach; ?> -->


      <h2 class="mt-3">Competition</h2>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Rank</th>
            <th scope="col">Event</th>
            <th scope="col">Field</th>
            <th scope="col">Description</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 ?>
          <?php foreach ($competition as $s) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><?= $s['name']; ?></td>
              <td><?= $s['rank']; ?></td>
              <td><?= $s['organiser']; ?></td>
              <td><?= $s['field']; ?></td>
              <td><?= $s['description']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>

    <div class="col-3">
      <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">An item</li>
          <li class="list-group-item">A second item</li>
          <li class="list-group-item">A third item</li>
        </ul>
        <div class="card-body">
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Message to <?= $user['name']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="/profile/sendMessage/<?= $user['id']; ?>">
        <?= csrf_field(); ?>
        <div class="modal-body">
          <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject">
          </div>

          <div class="mb-3">
            <label for="messageDescription" class="form-label">Message</label>
            <textarea type="text" class="form-control" id="messageDescription" aria-describedby="" name="messageDescription"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-success" type="submit">Send</button>
        </div>
      </form>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>