<?php if (isset($_POST['id'])): ?>
  <?php
  require_once __DIR__.'/../../../app/config.php';
  foreach ($db->table('jurusan')->join('petugas', 'petugas.register_petugas', '=', 'jurusan.register_petugas')->where('kode_jurusan', decode($_POST['id']))->get() as $rows);
  ?>
  <a onclick="changeurl('jurusan.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <form class="was-validated" action="#" method="post">
    <input type="hidden" id="id" value="<?= $rows->kode_jurusan; ?>" required>
    <div class="form-group">
      <label for="kode">Kode Jurusan</label>
      <input type="text" id="kode" class="form-control" value="<?= $rows->kode_jurusan; ?>" required disabled>
      <div id="showKode"></div>
    </div>
    <div class="form-group">
      <label for="nama">Nama Jurusan</label>
      <input type="text" name="nama" id="nama" class="form-control" value="<?= $rows->nama_jurusan; ?>" required>
    </div>
    <div class="form-group">
      <label for="petugas">Kajur</label>
      <select class="form-control" name="petugas" id="petugas">
        <optgroup label="Pilih Kajur">
          <option value="<?= $rows->register_petugas; ?>" hidden><?= $rows->nama_petugas; ?></option>
          <?php foreach ($db->table('petugas')->orderBy('nama_petugas')->get() as $key => $row): ?>
            <option value="<?= $row->register_petugas; ?>"><?= $row->nama_petugas; ?></option>
          <?php endforeach; ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-sm btn-success btn-block"><span class="fa fa-edit"></span> Edit</button>
    </div>
  </form>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#home').click( function() {
        $('#tampil').load('resource/views/jurusan/_show.php', {page: '<?= token(32); ?>'});
      });
      $("#nama").on("keyup",  function() {
        $.ajax({
          type: "POST",
          url: "resource/views/jurusan/inc/_kode.php",
          data: {id: $("#id").val(), nama: $("#nama").val()},
          cache: false,
          dataType: "json",
          success: function(data) {
            $("#kode").attr("value", data.htmlkodeajaran);
            $("#showKode").html(data.htmlentities);
          }
        });
      });
      $('form').submit( function(event) {
        event.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'resource/views/jurusan/inc/_update.php',
          data: {
            id: $('#id').val(),
            kode: $('#kode').val(),
            nama: $('#nama').val(),
            petugas: $('#petugas').val()
          },
          cache: false,
          success: function(response) {
            $('#tampil').load('resource/views/jurusan/_show.php', {page: '<?= token(32); ?>'});
            changeurl('jurusan.php');
            return getMessages();
          }
        });
      });
    });
  </script>
<?php endif; ?>
