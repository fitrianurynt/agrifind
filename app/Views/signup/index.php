<?= $this->extend('layout/templateOut'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="mt-5 mb-2">Sign Up</h1>

      <form action="/signup/createAccount" method="post">
        <?= csrf_field(); ?>

        <input type="hidden" name="hiddenDept" value="Department">

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input name="name" type="text" class="form-control <?= ($validation->hasError('name') ? 'is-invalid' : ''); ?>" id="name" placeholder="Name" value="<?= old('name'); ?>" autofocus>

          <div class="invalid-feedback">
            <?= $validation->getError('name'); ?>
          </div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input name="email" type="text" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : ''); ?>" id="email" placeholder="Email" value="<?= old('email'); ?>">

          <div class="invalid-feedback">
            <?= $validation->getError('email'); ?>
          </div>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input name="username" type="text" class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : ''); ?>" id="username" placeholder="Username" value="<?= old('username'); ?>">

          <div class="invalid-feedback">
            <?= $validation->getError('username'); ?>
          </div>
        </div>

        <div class="mb-3">
          <label for="nim" class="form-label">NIM</label>
          <input name="nim" type="text" class="form-control <?= ($validation->hasError('nim') ? 'is-invalid' : ''); ?>" id="nim" placeholder="NIM" value="<?= old('nim'); ?>">

          <div class="invalid-feedback">
            <?= $validation->getError('nim'); ?>
          </div>
        </div>

        <div class="mb-3">
          <label for="batch" class="form-label">Batch</label>
          <input name="batch" type="number" min="0" class="form-control <?= ($validation->hasError('batch') ? 'is-invalid' : ''); ?>" id="batch" placeholder="Batch" value="<?= old('batch'); ?>">

          <div class="invalid-feedback">
            <?= $validation->getError('batch'); ?>
          </div>
        </div>

        <div class="mb-3">
          <label for="department" class="form-label">Department</label>
          <select class="form-select <?= ($validation->hasError('department') ? 'is-invalid' : ''); ?>" aria-label="Default select example" id="department" name="department">
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

          <div class="invalid-feedback">
            <?= $validation->getError('department'); ?>
          </div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input name="password" type="password" class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : ''); ?>" id="password" placeholder="Password">

          <div class="invalid-feedback">
            <?= $validation->getError('password'); ?>
          </div>
        </div>

        <div class="mb-3">
          <label for="passconf" class="form-label">Password Confirmation</label>
          <input name="passconf" type="password" class="form-control <?= ($validation->hasError('passconf') ? 'is-invalid' : ''); ?>" id="passconf" placeholder="Confirm Password">

          <div class="invalid-feedback">
            <?= $validation->getError('passconf'); ?>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Sign Up</button>

      </form>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>