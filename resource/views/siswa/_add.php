<?php if (isset($_POST['page'])): ?>
  <a onclick="changeurl('siswa.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <?php require_once __DIR__.'/../../../app/config.php'; ?>
  <form class="was-validated" action="" method="post">
    <div class="form-group">
      <label for="nis">NIS Siswa</label>
      <input type="number" name="nis" id="nis" class="form-control" value="<?= Input::val('nis'); ?>" required>
      <div id="showNis"></div>
    </div>
    <div class="form-group">
      <label for="nama">Nama Siswa</label>
      <input type="text" name="nama" id="nama" class="form-control" value="<?= Input::val('nama'); ?>" required>
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
              <?php for ($i = date('Y')-25; $i <= date('Y')-13; $i++) { ?>
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
      <label for="kelas">Kelas</label>
      <select class="form-control" name="kelas" id="kelas" required>
        <optgroup label="Pilih Kelas">
          <?php
          if (isset($_POST['kelas'])) {
            foreach($db->table('kelas')->where('kode_kelas', $_POST['kelas'])->get() as $key => $kel);
            $kel = $kel->nama_kelas;
          }else {
            $kel = 'Pilih Kelas';
          }
          ?>
          <option hidden value="<?= Input::val('kelas'); ?>"><?= $kel; ?></option>
          <?php foreach($db->table('kelas')->orderBy('nama_kelas', 'ASC')->get() as $key => $row){ ?>
            <option value="<?= $row->kode_kelas; ?>"><?= $row->nama_kelas; ?></option>
          <?php } ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <label for="telepon">Telepon</label>
      <input type="number" name="telepon" id="telepon" value="<?= Input::val('telepon'); ?>" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" value="<?= Input::val('username'); ?>" class="form-control" required>
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-success btn-block" value="Save">
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
          url: 'resource/views/siswa/inc/_save.php',
          data: {
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
