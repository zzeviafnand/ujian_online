<?php if (isset($_POST['page'])): ?>
  <a onclick="changeurl('kbm.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <?php require_once __DIR__.'/../../../app/config.php'; ?>
  <form class="was-validated" method="post">
    <div class="form-group">
      <label for="semester">Tahun Ajaran & Semester</label>
      <select class="form-control" name="semester" id="semester">
        <optgroup label="Pilih Tahun Ajaran & Semester">
          <option value="" hidden>Pilih Tahun Ajaran & Semester</option>
          <?php foreach ($db->table('semester')->join('tahunajaran', 'tahunajaran.kode_tahunajaran', '=', 'semester.kode_tahunajaran')->orderBy('kategori_semester')->get() as $key => $row): ?>
            <option value="<?= $row->kode_semester; ?>"><?= $row->nama_tahunajaran; ?> & <?= $row->kategori_semester; ?>/<?= kateSemes($row->kategori_semester); ?></option>
          <?php endforeach; ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <label for="mapel">Mapel</label>
      <select class="form-control" name="mapel" id="mapel">
        <optgroup label="Pilih Mapel">
          <option value="" hidden>Pilih Mapel</option>
          <?php foreach ($db->table('mapel')->orderBy('nama_mapel')->get() as $key => $row): ?>
            <option value="<?= $row->id_mapel; ?>"><?= $row->nama_mapel; ?></option>
          <?php endforeach; ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <label for="guru">Guru</label>
      <select class="form-control" name="guru" id="guru">
        <optgroup label="Pilih Guru">
          <option value="" hidden>Pilih Guru</option>
          <?php foreach ($db->table('petugas')->where('level_petugas', 3)->orderBy('nama_petugas')->get() as $key => $row): ?>
            <option value="<?= $row->register_petugas; ?>"><?= $row->nama_petugas; ?></option>
          <?php endforeach; ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <input type="submit" name="simpan" class="btn btn-success btn-block" value="Save">
    </div>
  </form>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#error').hide();
      $('#home').click( function() {
        $('#tampil').load('resource/views/kbm/_show.php', {page: '<?= token(32); ?>'});
      });
      $('form').submit( function(event) {
        event.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'resource/views/kbm/inc/_save.php',
          data: {
            semester: $('#semester').val(),
            mapel: $('#mapel').val(),
            guru: $('#guru').val()
          },
          cache: false,
          success: function(response) {
            $('#tampil').load('resource/views/kbm/_show.php', {page: '<?= token(32); ?>'});
            changeurl('kbm.php');
            return getMessages();
          }
        });
      });
    });
  </script>
<?php endif; ?>
