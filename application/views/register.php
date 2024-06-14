<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/css/style.css">
  <link href="<?= base_url('/_temp/uploads/img/' . $favicon->value) ?>" rel="icon">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0" style="background:#142935!important">
        <div class="img-bg">
          <img src="<?=base_url()?>_temp/backend/security.gif" alt="logo" style="width:400px;position:fixed;bottom:0;right:0;">
        </div>
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="border-radius:5px;">
              <div class="brand-logo text-center">
                <img src="<?= base_url('/_temp/uploads/img/' . $logo->value) ?>" alt="logo">
              </div>
              <div class="text-center">
                <h5>Halo, Silahkan registrasi untuk login dulu</h5>
              </div>
              <?php echo form_open('register', array('id' => 'form', 'class' => 'pt-3')); ?>
			  <div class="form-group">
				<label for="no_kk">Nomor KK</label>
				<input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="Masukkan Nomor Kartu Keluarga" maxlength="16" required>
        <span class="text-warning"><?php echo form_error('no_kk'); ?></span>
			  </div>
			  <div class="form-group">
				<label for="no_ktp">Nomor KTP</label>
				<input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="Masukkan Nomor KTP" maxlength="16" required>
        <span class="text-warning"><?php echo form_error('no_ktp'); ?></span>
			  </div>
			  <div class="form-group">
				<label for="nama_lengkap">Nama Lengkap</label>
				<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"  placeholder="Masukkan Nama Lengkap" maxlength="50" required>
        <span class="text-warning"><?php echo form_error('nama_lengkap'); ?></span>
			  </div>
			  <div class="form-group">
          <label for="id_group">RT</label>
          <select class="form-control form-control-sm select2" data-placeholder=" -- Select -- " id="id_group" name="id_group" required>
              <?php foreach ($rt as $row): ?>
                  <option value="<?php echo $row->id; ?>"><?php echo strtoupper($row->nama); ?></option>
              <?php endforeach; ?>
          </select>
        </div>
			  <div class="form-group">
				<label for="tgl_lahir">Tanggal Lahir</label>
				<input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required max="<?php echo date('Y-m-d'); ?>">
			  </div>			  
			  <div class="form-group">
          <label for="jenis_kelamin">Jenis Kelamin</label>
          <select class="form-control form-control-sm select2" data-placeholder=" -- Select -- " id="jenis_kelamin" name="jenis_kelamin" required>
              <?php foreach ($kelamin as $row): ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->nama; ?></option>
              <?php endforeach; ?>
          </select>
        </div>
			  <div class="form-group">
				<label for="agama">Agama</label>
				<select class="form-control form-control-sm select2" data-placeholder=" -- Select -- " id="agama" name="agama" required>
        <?php foreach ($agama as $row): ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->nama; ?></option>
              <?php endforeach; ?>
				</select>
			  </div>
			  <div class="form-group">
				<label for="pendidikan_terakhir">Pendidikan Terakhir</label>
				<select class="form-control form-control-sm select2" data-placeholder=" -- Select -- " id="pendidikan_terakhir" name="pendidikan_terakhir" required>
        <?php foreach ($pendidikan as $row): ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->nama; ?></option>
              <?php endforeach; ?>
				</select>
			  </div>
			  <div class="form-group">
				<label for="id_profesi">Profesi</label>
				<select class="form-control form-control-sm select2" data-placeholder=" -- Select -- " id="id_profesi" name="id_profesi" required>
        <?php foreach ($profesi as $row): ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->nama; ?></option>
              <?php endforeach; ?>
				</select>
			  </div>
        <div class="form-group">
				<label for="status_warga">Status</label>
				<select class="form-control form-control-sm select2" data-placeholder=" -- Select -- " id="status_warga" name="status_warga" required>
        <?php foreach ($status as $row): ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->nama; ?></option>
              <?php endforeach; ?>
				</select>
			  </div>
			  <div class="form-group">
          <label for="hp">Nomor HP</label>
          <input type="text" class="form-control" id="hp" name="hp" placeholder="Masukkan Nomor Handphone" maxlength="13" required>
			  </div>
        <div class="form-group">
          <label for="email">Email</label>
                  <input type="text" class="form-control form-control-lg" id="email" placeholder="Masukkan Email" name="email" autocomplete="off">
              </div>
			  <div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
			  </div>
			  <div class="form-group">
				<label for="confirm_password">Konfirmasi Password</label>
				<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
			  </div>                
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit" id="submit">DAFTAR</button>
                </div>
                <?php echo form_close(); ?>
                <div class="mt-3">
                  <a href="<?=site_url(LOGIN_ROUTE)?>">Kembali ke Login</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script src="<?=base_url()?>_temp/backend/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url()?>_temp/backend/vendors/select2/select2.min.js"></script>
  <script>
    $(document).ready(function() {
    
      if ($(".select2").length) {
      $('.select2').select2();
    }

    $('#tgl_lahir').on('change', function() {
    var dob = new Date($(this).val());
    var now = new Date();
    if (dob > now) {
      $(this).val('');
      alert('Tanggal lahir tidak bisa di masa depan');
    }
  });

// Buat fungsi untuk validasi nomor KK atau nomor KTP
function validateNumericInput(selector) {
  $(selector).on("keyup", function() {
    // Ambil nilai dari input
    var value = $(this).val();
    
    // Validasi apakah input hanya berisi angka dan memiliki panjang 16 digit
    if (/^\d{16}$/.test(value)) {
      $(this).removeClass("is-invalid").addClass("is-valid");
    } else {
      $(this).removeClass("is-valid").addClass("is-invalid");
    }
  });
}

// Tambahkan event listener untuk input nomor KK
validateNumericInput("#no_kk");

// Tambahkan event listener untuk input nomor KTP
validateNumericInput("#no_ktp");

// Tambahkan event listener untuk input email
$("#email").on("keyup", function() {
  // Ambil nilai dari input email
  var email = $(this).val();
  
  // Validasi apakah input email valid menggunakan regular expression
  if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    $(this).removeClass("is-invalid").addClass("is-valid");
  } else {
    $(this).removeClass("is-valid").addClass("is-invalid");
  }
});

// Tambahkan event listener untuk input password atau konfirmasi password
$("#password, #confirm_password").on("keyup", function() {
  // Ambil nilai dari input password dan konfirmasi password
  var password = $("#password").val();
  var confirm_password = $("#confirm_password").val();
  
  // Jika password dan konfirmasi password tidak sama, tampilkan pesan kesalahan
  if (password != confirm_password) {
    $("#confirm_password").removeClass("is-valid").addClass("is-invalid");
  } else {
    $("#confirm_password").removeClass("is-invalid").addClass("is-valid");
  }
});

});

</script>
</body>
</html>
