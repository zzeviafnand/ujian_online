<?php if (isset($_POST['id'])): ?>
  <?php
  require_once __DIR__.'/../../../app/config.php';
  $fields = [
    'tahunajaran' => 'tahunajaran.kode_tahunajaran = semester.kode_tahunajaran',
    'semester' => 'semester.kode_semester = kbm.kode_semester',
    'mapel' => 'mapel.id_mapel = kbm.id_mapel',
    'petugas' => 'petugas.register_petugas = kbm.register_petugas',
  ];
  foreach ($db->table('kbm')->selfJoin($fields)->where('id_kbm', decode($_POST['id']))->get() as $rows);
  ?>
  <a onclick="changeurl('kbm.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <form class="was-validated" action="#" method="post">
    <input type="hidden" id="id" value="<?= $rows->id_kbm; ?>">
    <div class="form-group">
      <label for="semester">Tahun Ajaran & Semester</label>
      <select class="form-control" name="semester" id="semester">
        <optgroup label="Pilih Tahun Ajaran & Semester">
          <option value="<?= $rows->kode_semester; ?>" hidden><?= $rows->nama_tahunajaran; ?> &  & <?= $rows->kategori_semester; ?>/<?= kateSemes($rows->kategori_semester); ?></option>
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
          <option value="<?= $rows->id_mapel; ?>" hidden><?= $rows->nama_mapel; ?></option>
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
          <option value="<?= $rows->register_petugas; ?>" hidden><?= $rows->nama_petugas; ?></option>
          <?php foreach ($db->table('petugas')->where('level_petugas', 3)->orderBy('nama_petugas')->get() as $key => $row): ?>
            <option value="<?= $row->register_petugas; ?>"><?= $row->nama_petugas; ?></option>
          <?php endforeach; ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <input type="submit" name="perbarui" class="btn btn-success btn-block" value="Edit">
    </div>
  </form>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#home').click( function() {
        $('#tampil').load('resource/views/kbm/_show.php', {page: '<?= token(32); ?>'});
      });
      $('form').submit( function(event) {
        event.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'resource/views/kbm/inc/_update.php',
          data: {
            id: $('#id').val(),
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
