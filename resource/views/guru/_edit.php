<?php if (isset($_POST['id'])): ?>
  <?php
  require_once __DIR__.'/../../../app/config.php';
  foreach ($db->table('petugas')->where('register_petugas', decode($_POST['id']))->get() as $key => $rows);
  ?>
  <a onclick="changeurl('guru.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <form class="was-validated" action="" method="post">
    <input type="hidden" id="id" value="<?= $rows->register_petugas; ?>">
    <div class="form-group">
      <label for="register">No. Register</label>
      <input type="text" name="register" id="register" value="<?= $rows->register_petugas; ?>" class="form-control" required>
      <small>No. Register terdiri dari TAHUN MASUK + BULAN MASUK + NIPK. <br>Contoh : 2018010001</small>
    </div>
    <div class="form-group">
      <label for="nipk">NIP/K</label>
      <input type="text" name="nipk" id="nipk" value="<?= $rows->nipk_petugas; ?>" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="nama">Nama Guru</label>
      <input type="text" name="nama" id="nama" value="<?= $rows->nama_petugas; ?>" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="tempat">Tempat Lahir</label>
      <input type="text" name="tempat" id="tempat" class="form-control" value="<?= $rows->tempat_petugas; ?>" required>
    </div>
    <div class="form-group">
      <label for="tanggal">Tanggal Lahir</label>
      <div class="row">
        <div class="col-4 col-md-4">
          <select class="form-control" name="hari" id="hari" required>
            <optgroup label="Pilih Hari">
              <option hidden value="<?= substr($rows->tanggal_petugas, 8, 2); ?>"><?= substr($rows->tanggal_petugas, 8, 2); ?></option>
              <?php for ($i=1; $i <=31 ; $i++) { ?>
                <option value="<?= $i ?>"><?= $i ?></option>
              <?php } ?>
            </optgroup>
          </select>
          <p></p>
        </div>
        <div class="col-4 col-md-4">
          <select class="form-control" name="bulan" id="bulan" required>
            <optgroup label="Pilih Bulan">
              <option hidden value="<?= substr($rows->tanggal_petugas, 5, 2); ?>"><?= month(substr($rows->tanggal_petugas, 5, 2)); ?></option>
              <?php for ($i=1; $i <=12 ; $i++) { ?>
                <option value="<?= $i ?>"><?= month($i); ?></option>
              <?php } ?>
            </optgroup>
          </select>
          <p></p>
        </div>
        <div class="col-4 col-md-4">
          <select class="form-control" name="tahun" id="tahun" required>
            <optgroup label="Pilih Tahun">
              <option hidden value="<?= substr($rows->tanggal_petugas, 0, 4); ?>"><?= substr($rows->tanggal_petugas, 0, 4); ?></option>
              <?php for ($i = date('Y')-20; $i <= date('Y')-14; $i++) { ?>
                <option value="<?= $i ?>"><?= $i ?></option>
              <?php } ?>
            </optgroup>
          </select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <?php $check1 = ($rows->kelamin_petugas == 1)? 'checked' : ''; ?>
      <?php $check2 = ($rows->kelamin_petugas == 2)? 'checked' : ''; ?>
      <label for="kelamin">Jenis Kelamin</label><br>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" name="kelamin" id="kelamin1" value="1" class="custom-control-input" required <?= $check1; ?>>
        <label class="custom-control-label" for="kelamin1">Laki-Laki</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" name="kelamin" id="kelamin2" value="2" class="custom-control-input" required <?= $check2; ?>>
        <label class="custom-control-label" for="kelamin2">Perempuan</label>
      </div>
    </div>
    <div class="form-group">
      <label for="telepon">Telepon</label>
      <input type="tel" name="telepon" id="telepon" value="<?= $rows->telepon_petugas; ?>" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea class="form-control" name="alamat" id="alamat"  rows="8" cols="80" required><?= $rows->alamat_petugas; ?></textarea>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-sm btn-success btn-block"><span class="fa fa-edit"></span> Edit</button>
    </div>
  </form>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#home').click( function() {
        $('#tampil').load('resource/views/guru/_show.php', {page: '<?= token(32); ?>'});
      });
      $('form').submit( function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'resource/views/guru/inc/_update.php',
          data: {
            id: $('#id').val(),
            register: $('#register').val(),
            nipk: $('#nipk').val(),
            nama: $('#nama').val(),
            tempat: $('#tempat').val(),
            hari: $('#hari').val(),
            bulan: bulan = $('#bulan').val(),
            tahun: bulan = $('#tahun').val(),
            kelamin: $('input[name="kelamin"]:checked').val(),
            telepon: $('#telepon').val(),
            alamat: $('#alamat').val()
          },
          cache: false,
          success: function(data) {
            $('#tampil').load('resource/views/guru/_show.php', {page: '<?= token(32); ?>'});
            changeurl('guru.php');
            getMessages();
          }
        });
      });
    });
  </script>
<?php endif; ?>
