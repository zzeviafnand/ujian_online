<?php if (isset($_POST['page'])): ?>
  <?php require_once __DIR__.'/../../../app/config.php'; ?>
  <link rel="stylesheet" href="public/css/datetime/jquery.datepicker.min.css">
  <link rel="stylesheet" href="public/css/datetime/demo.css">
  <a onclick="changeurl('jadwal.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <form class="was-validated" action="" method="post">
    <div class="form-group">
      <label for="nama">Nama Jadwal</label>
      <input type="text" name="nama" id="nama" class="form-control" value="" required>
    </div>
    <div class="form-group">
      <label for="keterangan">Keterangan Jadwal</label>
      <input type="text" name="keterangan" id="keterangan" class="form-control" value="" required>
    </div>
    <div class="form-group">
      <label for="mapel">Mapel dan Guru</label>
      <select class="form-control" name="mapel" id="mapel" required>
        <optgroup label="Pilih Mapel dan Guru">
          <option hidden value="">Pilih Mapel dan Guru</option>
          <?php foreach($db->table('kbm')->selfJoin(['mapel' => 'mapel.id_mapel = kbm.id_mapel', 'petugas' => 'petugas.register_petugas = kbm.register_petugas'])->orderBy('nama_mapel', 'ASC')->get() as $key => $row){ ?>
          <option value="<?= $row->id_kbm; ?>"><?= $row->nama_mapel; ?> & <?= $row->nama_petugas; ?></option>
        <?php } ?>
        </optgroup>
      </select>
    </div>
    <div class="controls">
      <label for="kelas">Kelas</label>
      <div class="entry form-group">
        <div class="input-group">
          <select class="form-control kelas" name="kelas[]" id="kelas" required>
            <optgroup label="Pilih Kelas">
              <option hidden value="">Pilih Kelas</option>
              <?php foreach($db->table('kelas')->orderBy('nama_kelas', 'ASC')->get() as $key => $row){ ?>
              <option value="<?= $row->kode_kelas; ?>"><?= $row->nama_kelas; ?></option>
            <?php } ?>
            </optgroup>
          </select>
          <span class="input-group-btn">
            <button class="btn btn-success btn-add" type="button">
              <span class="fa fa-plus"></span>
            </button>
          </span>
  			</div>
      </div>
  	</div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="tanggalMulai">Tanggal Mulai Ujian</label>
          <input type="text" name="tanggalMulai" id="tanggalMulai" class="form-control" value="" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="tanggalSelesai">Tanggal Selesai Ujian</label>
          <input type="text" name="tanggalSelesai" id="tanggalSelesai" class="form-control" value="" required>
        </div>
      </div>
    </div>
    <div class="form-group">
    	<label for="waktu">Waktu(Menit)</label>
    	<input type="text" name="waktu" id="waktu" class="form-control" value="" required>
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-sm btn-success btn-block"><span class="fa fa-save"></span> Save</button>
    </div>
  </form>
  <script src="public/js/datetime/jquery.datepicker.min.js" charset="utf-8"></script>
  <script type="text/javascript">
  $('#tanggalMulai').datepicker({
    readonly: false,
    disabled: false,
    type: 'datetime',
    startDate: null,
    endDate: null,
    placeholder: '',
    zIndex: 999,
  });
  $('#tanggalSelesai').datepicker({
    readonly: false,
    disabled: false,
    type: 'datetime',
    startDate: null,
    endDate: null,
    placeholder: '',
    zIndex: 999,
  });
  $('li').datepicker('hide');
  $('li').on('hide.datepicker', function(){});
    $(document).ready( function() {
      $('#home').click( function() {
        $('#tampil').load('resource/views/jadwal/_show.php', {page: '<?= token(32); ?>'});
      });
      $('form').submit( function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'resource/views/jadwal/inc/_save.php',
          data: {
            nama: $('#nama').val(),
            keterangan: $('#keterangan').val(),
            tanggalMulai: $('#tanggalMulai').val(),
            tanggalSelesai: $('#tanggalSelesai').val(),
            waktu: $('#waktu').val(),
            mapel: $('#mapel').val(),
            kelas: $('select[name="kelas[]"]').serialize(),
          },
          cache: false,
          success: function(data) {
            $('#tampil').load('resource/views/jadwal/_show.php', {page: '<?= token(32); ?>'});
            changeurl('jadwal.php');
            return getMessages();
          }
        });
      });
    });
  </script>
<?php endif ?>
