<?php if (isset($_POST['id'])): ?>
  <?php
  require_once __DIR__.'/../../../app/config.php';
      $fields = [
        'kelas' => 'kelas.kode_kelas = jadwal.kode_kelas',
        'kbm' => 'jadwal.id_kbm = kbm.id_kbm',
        'mapel' => 'kbm.id_mapel = mapel.id_mapel',
        'petugas' => 'kbm.register_petugas = petugas.register_petugas',
      ];
      foreach ($db->table('jadwal')->selfJoin($fields)->where('jadwal.id_jadwal', decode($_POST['id']))->get() as $key => $rows);
  ?>
  <link rel="stylesheet" href="public/css/datetime/jquery.datepicker.min.css">
  <link rel="stylesheet" href="public/css/datetime/demo.css">
  <a onclick="changeurl('jadwal.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <form class="was-validated" action="" method="post">
    <input type="hidden" id="id" value="<?= $rows->id_jadwal; ?>">
    <div class="form-group">
      <label for="nama">Nama Ujian</label>
      <input type="text" name="nama" id="nama" class="form-control" value="<?= $rows->nama_jadwal ?>">
    </div>
    <div class="form-group">
      <label for="keterangan">Keterangan Ujian</label>
      <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= $rows->keterangan_jadwal ?>">
    </div>
    <div class="form-group">
      <label for="mapel">Mapel dan Guru</label>
      <select class="form-control" name="mapel" id="mapel" required>
        <optgroup label="Pilih Mapel dan Guru">
          <option hidden value="<?= $rows->id_kbm; ?>"><?= $rows->nama_mapel; ?> & <?= $rows->nama_petugas; ?></option>
          <?php foreach($db->table('kbm')->selfJoin(['mapel' => 'mapel.id_mapel = kbm.id_mapel', 'petugas' => 'petugas.register_petugas = kbm.register_petugas'])->orderBy('nama_mapel', 'ASC')->get() as $key => $row){ ?>
          <option value="<?= $row->id_kbm; ?>"><?= $row->nama_mapel; ?> & <?= $row->nama_petugas; ?></option>
          <?php } ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <label for="kelas">Kelas</label>
      <select class="form-control" name="kelas" id="kelas" required>
        <optgroup label="Pilih Kelas">
          <option hidden value="<?= $rows->kode_kelas ?>"><?= $rows->nama_kelas ?></option>
          <?php foreach($db->table('kelas')->orderBy('nama_kelas')->get() as $key => $row){ ?>
          <option value="<?= $row->kode_kelas; ?>"><?= $row->nama_kelas; ?></option>
        <?php } ?>
        </optgroup>
      </select>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="tanggalMulai">Tanggal Mulai Ujian</label>
          <input type="text" name="tanggalMulai" id="tanggalMulai" class="form-control" value="<?= $rows->tanggal_mulai_jadwal; ?>" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="tanggalSelesai">Tanggal Selesai Ujian</label>
          <input type="text" name="tanggalSelesai" id="tanggalSelesai" class="form-control" value="<?= $rows->tanggal_selesai_jadwal; ?>" required>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="waktu">Waktu(Menit)</label>
      <input type="number" name="waktu" id="waktu" class="form-control" value="<?= $rows->waktu_jadwal; ?>">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-sm btn-success btn-block"><span class="fa fa-edit"></span> Edit</button>
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
          url: 'resource/views/jadwal/inc/_update.php',
          data: {
            id: $('#id').val(),
            nama: $('#nama').val(),
            keterangan: $('#keterangan').val(),
            tanggalMulai: $('#tanggalMulai').val(),
            tanggalSelesai: $('#tanggalSelesai').val(),
            waktu: $('#waktu').val(),
            mapel: $('#mapel').val(),
            kelas: $('#kelas').val(),
          },
          cache: false,
          success: function(data) {
            $('#tampil').html(data);
            $('#tampil').load('resource/views/jadwal/_show.php', {page: '<?= token(32); ?>'});
            changeurl('jadwal.php');
            return getMessages();
          }
        });
      });
    });
  </script>
<?php endif ?>
