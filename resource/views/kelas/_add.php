<?php if (isset($_POST['page'])): ?>
  <a onclick="changeurl('kelas.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <?php require_once __DIR__.'/../../../app/config.php'; ?>
  <form class="was-validated" method="post">
    <div class="form-group">
      <label for="kode">Kode kelas</label>
      <input type="text" id="kode" class="form-control" value="" required disabled>
      <div id="showKode"></div>
    </div>
    <div class="form-group">
      <label for="nama">Nama Kelas</label>
      <input type="text" id="nama" class="form-control" value="">
    </div>
    <div class="form-group">
      <label for="jurusan">Jurusan</label>
      <select class="form-control" name="jurusan" id="jurusan">
        <optgroup label="Pilih Jurusan">
          <option value="" hidden>Pilih Jurusan</option>
          <?php foreach ($db->table('jurusan')->orderBy('nama_jurusan')->get() as $key => $row): ?>
            <option value="<?= $row->kode_jurusan; ?>"><?= $row->nama_jurusan; ?></option>
          <?php endforeach; ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <label for="petugas">Wali Kelas</label>
      <select class="form-control" name="petugas" id="petugas">
        <optgroup label="Pilih Wali Kelas">
          <option value="" hidden>Pilih Wali Kelas</option>
          <?php foreach ($db->table('petugas')->orderBy('nama_petugas')->get() as $key => $row): ?>
            <option value="<?= $row->register_petugas; ?>"><?= $row->nama_petugas; ?></option>
          <?php endforeach; ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <label for="tahunajaran">Tahun Ajaran</label>
      <select class="form-control" name="tahunajaran" id="tahunajaran">
        <optgroup label="Pilih Tahun Ajaran">
          <option value="" hidden>Pilih Tahun Ajaran</option>
          <?php foreach ($db->table('tahunajaran')->orderBy('nama_tahunajaran')->get() as $key => $row): ?>
            <option value="<?= $row->kode_tahunajaran; ?>"><?= $row->nama_tahunajaran; ?></option>
          <?php endforeach; ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-sm btn-success btn-block"><span class="fa fa-save"></span> Save</button>
    </div>
  </form>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#error').hide();
      $('#home').click( function() {
        $('#tampil').load('resource/views/kelas/_show.php', {page: '<?= token(32); ?>'});
      });
      $("#nama").on("keyup", function() {
        $.ajax({
          type: "POST",
          url: "resource/views/kelas/inc/_kode.php",
          data: {nama: $("#nama").val()},
          cache: false,
          dataType: "json",
          success: function(data) {
            $("#kode").attr("value", data.htmlkodeajaran);
            $("#showKode").html(data.htmlentities);
          }
        });
      });
      $('form').submit( function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'resource/views/kelas/inc/_save.php',
          data: {
            kode: $('#kode').val(),
            nama: $('#nama').val(),
            jurusan: $('#jurusan').val(),
            petugas: $('#petugas').val(),
            tahunajaran: $('#tahunajaran').val()
          },
          cache: false,
          success: function(response) {
            $('#tampil').load('resource/views/kelas/_show.php', {page: '<?= token(32); ?>'});
            changeurl('kelas.php');
            return getMessages();
          }
        });
      });
    });
  </script>
<?php endif; ?>
