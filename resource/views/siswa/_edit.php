<?php if (isset($_POST['id'])): ?>
  <?php
  require_once __DIR__.'/../../../app/config.php';
  foreach ($db->table('siswa')->join('kelas', 'siswa.kode_kelas', '=', 'kelas.kode_kelas')->where('nis_siswa', decode($_POST['id']))->get() as $keys => $rows);
  ?>
  <a onclick="changeurl('siswa.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <form class="was-validated" action="" method="post">
    <input type="hidden" id="id" value="<?= $rows->nis_siswa; ?>">
    <div class="form-group">
      <label for="nis">NIS Siswa</label>
      <input type="text" name="nis" id="nis" class="form-control" value="<?= $rows->nis_siswa; ?>" required>
      <div id="showNis"></div>
    </div>
    <div class="form-group">
      <label for="nama">Nama Siswa</label>
      <input type="text" name="nama" id="nama" class="form-control" value="<?= $rows->nama_siswa; ?>" required>
    </div>
    <div class="form-group">
      <label for="tempat">Tempat Lahir</label>
      <input type="text" name="tempat" id="tempat" class="form-control" value="<?= $rows->tempat_siswa; ?>" required>
    </div>
    <div class="form-group">
      <label for="tanggal">Tanggal Lahir</label>
      <div class="row">
        <div class="col-4 col-md-4">
          <select class="form-control" name="hari" id="hari" required>
            <optgroup label="Pilih Hari">
              <option hidden value="<?= substr($rows->tanggal_siswa, 8, 2); ?>"><?= substr($rows->tanggal_siswa, 8, 2); ?></option>
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
              <option hidden value="<?= substr($rows->tanggal_siswa, 5, 2); ?>"><?= month(substr($rows->tanggal_siswa, 5, 2)); ?></option>
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
              <option hidden value="<?= substr($rows->tanggal_siswa, 0, 4); ?>"><?= substr($rows->tanggal_siswa, 0, 4); ?></option>
              <?php for ($i = date('Y')-25; $i <= date('Y')-13; $i++) { ?>
                <option value="<?= $i ?>"><?= $i ?></option>
              <?php } ?>
            </optgroup>
          </select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <?php $check1 = ($rows->kelamin_siswa == 1)? 'checked' : ''; ?>
      <?php $check2 = ($rows->kelamin_siswa == 2)? 'checked' : ''; ?>
      <label for="kelamin">Jenis Kelamin</label><br>
      <div class="custom-control custom-radio custom-control-inline" id="kelamin">
        <input type="radio" name="kelamin" id="kelamin1" value="1" class="custom-control-input kelamin" required <?= $check1; ?>>
        <label class="custom-control-label" for="kelamin1">Laki-Laki</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline" id="kelamin">
        <input type="radio" name="kelamin" id="kelamin2" value="2" class="custom-control-input kelamin" required <?= $check2; ?>>
        <label class="custom-control-label" for="kelamin2">Perempuan</label>
      </div>
    </div>
    <div class="form-group">
      <label for="kelas">Kelas</label>
      <select class="form-control" name="kelas" id="kelas" required>
        <optgroup label="Pilih Kelas">
          <option hidden value="<?= $rows->kode_kelas; ?>"><?= $rows->nama_kelas; ?></option>
          <?php foreach($db->table('kelas')->orderBy('nama_kelas', 'ASC')->get() as $key => $row){ ?>
            <option value="<?= $row->kode_kelas; ?>"><?= $row->nama_kelas; ?></option>
          <?php } ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <label for="telepon">Telepon</label>
      <input type="tel" name="telepon" id="telepon" value="<?= $rows->telepon_siswa; ?>" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" value="<?= $rows->username; ?>" class="form-control" required>
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-success btn-block" value="Edit">
    </div>
  </form>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#home').click( function() {
        $('#tampil').load('resource/views/siswa/_show.php', {page: '<?= token(32); ?>'});
      });
      $('form').submit( function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'resource/views/siswa/inc/_update.php',
          data: {
            id: $('#id').val(),
            nis: $('#nis').val(),
            nama: $('#nama').val(),
            tempat: $('#tempat').val(),
            hari: $('#hari').val(),
            bulan: bulan = $('#bulan').val(),
            tahun: bulan = $('#tahun').val(),
            kelamin: $('input[name="kelamin"]:checked').val(),
            kelas: $('#kelas').val(),
            telepon: $('#telepon').val(),
            username: $('#username').val()
          },
          cache: false,
          success: function(response) {
            $('#tampil').html(response);
            $('#tampil').load('resource/views/siswa/_show.php', {page: '<?= token(32); ?>'});
            changeurl('siswa.php');
            return getMessages();
          }
        });
      });
      $('#nis').on('keyup', function() {
        var nis = $('#nis').val();
        $.ajax({
          type: 'POST',
          url: 'resource/views/siswa/inc/_nis.php',
          data: {nis: nis},
          cache: false,
          success: function(response) {
            $('#showNis').html(response);
          }
        });
      });
    });
  </script>
<?php endif; ?>
