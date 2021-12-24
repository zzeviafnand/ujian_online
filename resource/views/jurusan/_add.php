<?php if (isset($_POST['page'])): ?>
  <a onclick="changeurl('jurusan.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <?php require_once __DIR__.'/../../../app/config.php'; ?>
  <form class="was-validated" method="post">
    <div class="form-group">
      <label for="kode">Kode Jurusan</label>
      <input type="text" id="kode" class="form-control" value="" required disabled>
      <div id="showKode"></div>
    </div>
    <div class="form-group">
      <label for="nama">Nama Jurusan</label>
      <input type="text" id="nama" class="form-control" value="" required>
    </div>
    <div class="form-group">
      <label for="petugas">Kajur</label>
      <select class="form-control" name="petugas" id="petugas" required>
        <optgroup label="Pilih Kajur">
          <option value="" hidden>Pilih Kajur</option>
          <?php foreach ($db->table('petugas')->orderBy('nama_petugas')->get() as $key => $row): ?>
            <option value="<?= $row->register_petugas; ?>"><?= $row->nama_petugas; ?></option>
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
        $('#tampil').load('resource/views/jurusan/_show.php', {page: '<?= token(32); ?>'});
      });
      $("#nama").on("keyup",  function() {
        $.ajax({
          type: "POST",
          url: "resource/views/jurusan/inc/_kode.php",
          data: {nama: $("#nama").val()},
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
          url: 'resource/views/jurusan/inc/_save.php',
          data: {
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
