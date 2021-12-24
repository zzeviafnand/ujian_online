<?php if (isset($_POST['page'])): ?>
  <a onclick="changeurl('petugas.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <?php require_once __DIR__.'/../../../app/config.php'; ?>
  <form class="was-validated" action="" method="post">
    <div class="form-group">
  		<label for="register">No. Register</label>
      <input type="text" name="register" id="register" value="" class="form-control" required>
      <small>No. Register terdiri dari TAHUN MASUK + BULAN MASUK + NIPK. <br>Contoh : 2018010001</small>
  	</div>
  	<div class="form-group">
  		<label for="nipk">NIPK</label>
  		<input type="text" name="nipk" id="nipk" value="" class="form-control" required>
  	</div>
  	<div class="form-group">
  		<label for="nama">Nama Petugas</label>
      <input type="text" name="nama" id="nama" value="" class="form-control" required>
  	</div>
    <div class="form-group">
      <label for="tempat">Tempat Lahir</label>
      <input type="text" name="tempat" id="tempat" class="form-control" value="<?= Input::val('tempat'); ?>" required>
    </div>
    <div class="form-group">
      <label for="tanggal">Tanggal Lahir</label>
      <div class="row">
        <div class="col-4 col-md-4">
          <select class="form-control" name="hari" id="hari" required>
            <optgroup label="Pilih Hari">
              <option hidden value="<?= Input::val('hari'); ?>"><?= Input::val('hari', 'Hari'); ?></option>
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
              <?php
              if (isset($_POST['bulan'])) {
                $mot = month($_POST['bulan']);
              }else {
                $mot = Input::val('bulan', 'Bulan');
              }
              ?>
              <option hidden value="<?= Input::val('bulan'); ?>"><?= $mot; ?></option>
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
              <option hidden value="<?= Input::val('tahun'); ?>"><?= Input::val('tahun', 'Tahun'); ?></option>
              <?php for ($i = date('Y')-60; $i <= date('Y')-20; $i++) { ?>
                <option value="<?= $i ?>"><?= $i ?></option>
              <?php } ?>
            </optgroup>
          </select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="kelamin">Jenis Kelamin</label><br>
      <div class="custom-control custom-radio custom-control-inline">
        <?php
          $jk = '';
          $jk2 = '';
          if (isset($_POST['kelamin'])) {
            if ($_POST['kelamin'] == 2) {
              $jk2 = 'checked';
            } else {
              $jk = 'checked';
            }
          }else {
            $jk = 'checked';
          }
         ?>
        <input type="radio" name="kelamin" id="kelamin1" value="1" class="custom-control-input" required <?= $jk; ?>>
        <label class="custom-control-label" for="kelamin1">Laki-Laki</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" name="kelamin" id="kelamin2" value="2" class="custom-control-input" required <?= $jk2; ?>>
        <label class="custom-control-label" for="kelamin2">Perempuan</label>
      </div>
    </div>
  	<div class="form-group">
  		<label for="telepon">Telepon</label>
      <input type="tel" name="telepon" id="telepon" value="" class="form-control" required>
  	</div>
    <div class="form-group">
      <label for="level">Level</label>
      <select class="form-control" name="level" id="level" required>
        <optgroup label="Pilih Level">
          <option value="<?= (empty($_POST['level'])) ? 'Pilih Level': $_POST['level']; ?>" hidden><?= (empty($_POST['level'])) ? 'Pilih Level' : level($_POST['level']); ?></option>
          <?php for ($i=1; $i <= 4 ; $i++) { ?>
            <option value="<?= $i; ?>"><?= level($i); ?></option>
          <?php } ?>
        </optgroup>
      </select>
    </div>
  	<div class="form-group">
  		<label for="alamat">Alamat</label>
      <textarea class="form-control" required name="alamat" id="alamat"  rows="8" cols="80"></textarea>
  	</div>
    <div class="form-group">
      <button type="submit" class="btn btn-sm btn-success btn-block"><span class="fa fa-save"></span> Save</button>
    </div>
  </form>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#home').click( function() {
        $('#tampil').load('resource/views/petugas/_show.php', {page: '<?= token(32); ?>'});
      });
      $('form').submit( function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'resource/views/petugas/inc/_save.php',
          data: {
            register: $('#register').val(),
            nipk: $('#nipk').val(),
            nama: $('#nama').val(),
            tempat: $('#tempat').val(),
            hari: $('#hari').val(),
            bulan: bulan = $('#bulan').val(),
            tahun: bulan = $('#tahun').val(),
            kelamin: $('input[name="kelamin"]:checked').val(),
            telepon: $('#telepon').val(),
            level: $('#level').val(),
            alamat: $('#alamat').val()
          },
          cache: false,
          success: function(data) {
            $("#tampil").html(data);
          }
        });
      });
    });
  </script>
<?php endif; ?>
