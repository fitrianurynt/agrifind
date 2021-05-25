<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row mb-5">
    <div class="col">
      <h1 class="mt-5 mb-2">Setting</h1>

      <!-- setting navbar -->
      <?= $this->include('layout/navbarSetting'); ?>

      <h2 class="mb-5 mt-3">General Setting</h2>

      <h3>Profile</h3>

      <form action="/setting/editGeneral" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <input type="hidden" name="id" value="<?= $user['id']; ?>">
        <input type="hidden" name="hiddenDept" value="<?= $user['department'] ?>">
        <input type="hidden" name="hiddenName" value="<?= $user['name'] ?>">
        <input type="hidden" name="hiddenAvatar" value="<?= $user['avatar'] ?>">
        <input type="hidden" name="hiddenHeader" value="<?= $user['header'] ?>">
        <input type="hidden" name="hiddenCV" value="<?= $user['cv'] ?>">

        <!-- profile picture -->
        <div class="row mb-3">
          <label for="avatar" class="col-sm-2 col-form-label">Profile Picture</label>

          <div class="col-sm-2">
            <img src="/img/profile/<?= $user['avatar']; ?>" class="img-thumbnail img-preview">
          </div>

          <div class="col-sm-6">
            <div class="input-group mb-3">
              <input type="file" class="form-control <?= ($validation->hasError('avatar') ? 'is-invalid' : ''); ?>" id="avatar" name="avatar">

              <div class="invalid-feedback">
                <?= $validation->getError('avatar'); ?>
              </div>
              <!-- <label class="input-group-text" for="avatar">Upload</label> -->
            </div>
          </div>

          <div class="col-sm-2">
            <a href="/setting/removeProfilePicture" class="btn btn-danger">Remove Picture</a>
          </div>
        </div>

        <!-- header -->
        <div class="row mb-3">
          <label for="header" class="col-sm-2 col-form-label">Profile Header</label>

          <div class="col-sm-2">
            <img src="/img/header/<?= $user['header']; ?>" class="img-thumbnail img-preview">
          </div>

          <div class="col-sm-6">
            <div class="input-group mb-3">
              <input type="file" class="form-control <?= ($validation->hasError('header') ? 'is-invalid' : ''); ?>" id="header" name="header">

              <div class="invalid-feedback">
                <?= $validation->getError('header'); ?>
              </div>
              <!-- <label class="input-group-text" for="avatar">Upload</label> -->
            </div>
          </div>

          <div class="col-sm-2">
            <a href="/setting/removeHeader" class="btn btn-danger">Remove Picture</a>
          </div>
        </div>

        <!-- cv -->
        <div class="row mb-3">
          <label for="cv" class="col-sm-2 col-form-label">Profile CV</label>

          <!-- <div class="col-sm-2">
            <embed src="/docs/cv/<?= $user['cv']; ?>" type="">
            <img src="/docs/cv/<?= $user['cv']; ?>" class="img-thumbnail img-preview">
          </div> -->

          <div class="col-sm-8">
            <div class="input-group mb-3">
              <input type="file" class="form-control <?= ($validation->hasError('cv') ? 'is-invalid' : ''); ?>" id="cv" name="cv">

              <div class="invalid-feedback">
                <?= $validation->getError('cv'); ?>
              </div>

            </div>
          </div>

          <div class="col-sm-2">
            <a href="/setting/removeCV" class="btn btn-danger">Remove CV</a>
          </div>
        </div>


        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="<?= $user['name'] ?>">

        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="<?= $user['email'] ?>">
        </div>

        <fieldset disabled>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input name="username" type="text" class="form-control disabled" id="username" placeholder="Username" value="<?= $user['username'] ?>">
            <div id="emailHelp" class="form-text">Can't change username.</div>
          </div>
        </fieldset>

        <div class="mb-3">
          <label for="nim" class="form-label">NIM</label>
          <input name="nim" type="text" class="form-control" id="nim" placeholder="NIM" value="<?= $user['nim'] ?>">
        </div>
        
        <div class="mb-3">
          <label for="batch" class="form-label">Batch</label>
          <input name="batch" type="number" min=0 class="form-control" id="batch" placeholder="batch" value="<?= $user['batch'] ?>">
        </div>

        <div class="mb-3">
          <label for="department" class="form-label">Department</label>
          <select class="form-select" aria-label="Default select example" id="department" name="department">
            <option selected disabled>Department</option>
            <option disabled>Fakultas Pertanian (Faperta)</option>
            <option value="Manajemen Sumberdaya Lahan"> A1 - Manajemen Sumberdaya Lahan</option>
            <option value="Agronomi dan Hortikultura"> A2 - Agronomi dan Hortikultura</option>
            <option value="Proteksi Tanaman"> A3 - Proteksi Tanaman</option>
            <option value="Arsitektur Lanskap"> A4 - Arsitektur Lanskap</option>

            <option disabled>Fakultas Kedokteran Hewan (FKH)</option>
            <option value="Kedokteran Hewan"> B1 - Kedokteran Hewan</option>

            <option disabled>Fakultas Perikanan (FPIK)</option>
            <option value="Teknologi dan Manajemen Perikanan Budidaya"> C1 - Teknologi dan Manajemen Perikanan Budidaya</option>
            <option value="Manajemen Sumberdaya Perairan"> C2 - Manajemen Sumberdaya Perairan</option>
            <option value="Teknologi Hasil Perairan"> C3 - Teknologi Hasil Perairan</option>
            <option value="Teknologi dan Manajemen Perikanan Tangkap"> C4 - Teknologi dan Manajemen Perikanan Tangkap</option>
            <option value="Ilmu dan Teknologi Kelautan"> C5 - Ilmu dan Teknologi Kelautan</option>

            <option disabled>Fakultas Peternakan (Fapet)</option>
            <option value="Teknologi Produksi Ternak"> D1 - Teknologi Produksi Ternak </option>
            <option value="Nutrisi dan Teknologi Pakan"> D2 - Nutrisi dan Teknologi Pakan</option>
            <option value="Teknologi Hasil Ternak"> D3 - Teknologi Hasil Ternak</option>

            <option disabled>Fakultas Kehutanan (Fahutan)</option>
            <option value="Manajemen Hutan"> E1 - Manajemen Hutan</option>
            <option value="Teknologi Hasil Hutan"> E2 - Teknologi Hasil Hutan</option>
            <option value="Konservasi Sumberdaya Hutan dan Ekowisata"> E3 - Konservasi Sumberdaya Hutan dan Ekowisata</option>
            <option value="Silvikultur"> E4 - Silvikultur</option>

            <option disabled>Fakultas Teknologi Pertanian (Fateta)</option>
            <option value="Teknik Pertanian dan Biosistem"> F1 - Teknik Pertanian dan Biosistem</option>
            <option value="Teknologi Pangan"> F2 -Teknologi Pangan</option>
            <option value="Teknik Industri Pertanian"> F3 - Teknik Industri Pertanian</option>
            <option value="Teknik Sipil dan Lingkungan"> F4 - Teknik Sipil dan Lingkungan</option>

            <option disabled>Fakultas Matematika dan Ilmu Pengetahuan Alam (FMIPA)</option>
            <option value="Statistika dan Sains Data"> G1 - Statistika dan Sains Data</option>
            <option value="Meteorologi Terapan"> G2 -Meteorologi Terapan </option>
            <option value="Biologi"> G3 - Biologi</option>
            <option value="Kimia"> G4 - Kimia</option>
            <option value="Matematika"> G5 - Matematika</option>
            <option value="Ilmu Komputer"> G6 - Ilmu Komputer</option>
            <option value="Fisika"> G7 - Fisika</option>
            <option value="Biokimia"> G8 - Biokimia</option>
            <option value="Aktuaria"> G9 - Aktuaria</option>

            <option disabled>Fakultas Ekonomi dan Manajemen (FEM)</option>
            <option value="Ekonomi Pembangunan"> H1 - Ekonomi Pembangunan</option>
            <option value="Manajemen"> H2 -Manajemen </option>
            <option value="Agribisnis"> H3 - Agribisnis</option>
            <option value="Ekonomi Sumberdaya dan Lingkungan"> H4 - Ekonomi Sumberdaya dan Lingkungan</option>
            <option value="Ekonomi Syariah"> H5 - Ekonomi Syariah</option>

            <option disabled>Fakultas Ekologi Manusia (Fema)</option>
            <option value="Ilmu Gizi"> I1 - Ilmu Gizi</option>
            <option value="Ilmu Keluarga dan Konsumen"> I2 - Ilmu Keluarga dan Konsumen</option>
            <option value="Komunikasi dan Pengembangan Masyarakat"> I3 - Komunikasi dan Pengembangan Masyarakat</option>

            <option disabled>Sekolah Bisnis (SB)</option>
            <option value="Bisnis"> K1 Bisnis</option>
          </select>
        </div>

        <h3 class="mt-5">About Me</h3>

        <fieldset class="mb-3">
          <legend for="radio-avail" class="col-form-label col-sm-2 pt-0">Availability</legend>
          <div class="mb-3" id="radio-avail">
            <input type="radio" class="btn-check" name="availability" id="success-outlined" autocomplete="off" value="Available" <?= ($user['availability'] == 'Available') ? 'checked' : ''; ?>>
            <label class="btn btn-outline-success" for="success-outlined">Available</label>

            <input type="radio" class="btn-check" name="availability" id="danger-outlined" autocomplete="off" value="Unavailable" <?= ($user['availability'] == 'Unavailable') ? 'checked' : ''; ?>>
            <label class="btn btn-outline-danger" for="danger-outlined">Unavailable</label>

            <input type="radio" class="btn-check" name="availability" id="warning-outlined" autocomplete="off" value="Do Not Disturb" <?= ($user['availability'] == 'Do Not Disturb') ? 'checked' : ''; ?>>
            <label class="btn btn-outline-warning" for="warning-outlined">Do Not Disturb</label>

          </div>

        </fieldset>


        <!-- <div class="form-check">
          <input class="form-check-input" type="radio" name="availability" id="availability1" value="Available" <?= ($user['availability'] == 'Available') ? 'checked' : ''; ?>>
          <label class="form-check-label" for="availability1">
            Available
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="availability" id="availability2" value="Unavailable" <?= ($user['availability'] == 'Unavailable') ? 'checked' : ''; ?>>
          <label class="form-check-label" for="availability2">
            Unavailable
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="availability" id="availability2" value="Do Not Disturb" <?= ($user['availability'] == 'Do Not Disturb') ? 'checked' : ''; ?>>
          <label class="form-check-label" for="availability2">
            Do Not Disturb
          </label>
        </div> -->

        <div class="mb-3">
          <label for="about_me" class="form-label">About Me</label>
          <input name="about_me" type="text" class="form-control" id="about_Me" placeholder="aboutMe" value="<?= $general['about_me'] ?>">
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone" value="<?= $general['phone'] ?>">
        </div>

        <div class="mb-3">
          <label for="profession" class="form-label">Profession</label>
          <input name="profession" type="text" class="form-control" id="profession" placeholder="Profession" value="<?= $general['profession'] ?>">
        </div>

        <div class="mb-3">
          <label for="experience" class="form-label">Experience (<?= $general['experience'] ?>)</label>
          <input name="experience" type="range" class="form-range" min="0" max="10" step="0.5" id="experience" value="<?= $general['experience'] ?>">
        </div>



        <button type="submit" class="btn btn-primary">Save Change</button>

      </form>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>