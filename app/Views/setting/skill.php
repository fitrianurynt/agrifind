<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="mt-5 mb-2">Setting</h1>

      <!-- setting navbar -->
      <?= $this->include('layout/navbarSetting'); ?>

      <h2 class="mb-5 mt-3">Skills and Competition Setting</h2>

      <h3>Skills</h3>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSkill">
        Add Skill
      </button>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Skill</th>
            <th scope="col">Level</th>
            <th scope="col">Decription</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 ?>
          <?php foreach ($skill as $s) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><?= $s['name']; ?></td>
              <td><?= $s['level']; ?></td>
              <td><?= $s['description']; ?></td>
              <td><a href="/setting/deleteSkill/<?= $s['skill_id']; ?>" class="btn btn-danger">Delete</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <br>

      <h3>Competition</h3>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompetition">
        Add Competition
      </button>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Rank</th>
            <th scope="col">Event</th>
            <th scope="col">Field</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
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
              <td><a href="/setting/deleteCompetition/<?= $s['competition_id']; ?>" class="btn btn-danger">Delete</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<!-- Modal Skill -->
<div class="modal fade" id="addSkill" tabindex="-1" aria-labelledby="addSkill" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSkillLabel">Add Skill</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/setting/addSkill">
        <div class="modal-body">


          <input type="hidden" name="hiddenUserId" value="<?= $user['id']; ?>">

          <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input name="nameSkill" type="text" class="form-control" id="name">
            </div>
          </div>

          <div class="row mb-3">
            <label for="level" class="col-sm-2 col-form-label">Level</label>
            <div class="col-sm-10">
              <input name="levelSkill" type="number" class="form-control" id="level" max="10" min="0" step="0.5">
            </div>
          </div>

          <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
              <input name="descriptionSkill" type="text" class="form-control" id="name">
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- Modal Competition -->
<div class="modal fade" id="addCompetition" tabindex="-1" aria-labelledby="addCompetition" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCompetitionLabel">Add Competition</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/setting/addCompetition">
        <div class="modal-body">

          <input type="hidden" name="hiddenUserId" value="<?= $user['id']; ?>">

          <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input name="nameComp" type="text" class="form-control" id="name">
            </div>
          </div>

          <div class="row mb-3">
            <label for="rank" class="col-sm-2 col-form-label">Rank</label>
            <div class="col-sm-10">
              <select class="form-select" aria-label="Default select example" name="rankComp">
                <option class="" selected value="">-</option>
                <option value="1st">1st</option>
                <option value="2nd">2nd</option>
                <option value="3rd">3rd</option>
                <option value="Favorite">Favorite</option>
                <option value="Honorable Mention">Honorable Mention</option>
                <option value="Participate">Participate</option>
                <option value="Other">Other</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="organiser" class="col-sm-2 col-form-label">Organiser</label>
            <div class="col-sm-10">
              <input name="organiserComp" type="text" class="form-control" id="organiser">
            </div>
          </div>

          <div class="row mb-3">
            <label for="field" class="col-sm-2 col-form-label">Field</label>
            <div class="col-sm-10">
              <input name="fieldComp" type="text" class="form-control" id="field">
            </div>
          </div>


          <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
              <input name="descriptionComp" type="text" class="form-control" id="name">
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>