<?php if (isset($_POST['page'])): ?>
  <a onclick="changeurl('semester.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <?php require_once __DIR__.'/../../../app/config.php'; ?>
  <form class="was-validated" method="post">
    <div class="form-group">
      <label for="kode">Kode Semester</label>
      <input type="text" id="kode" class="form-control" value="" required disabled>
      <div id="showKode"></div>
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
      <label for="semester">Semester</label>
      <select class="form-control" name="semester" id="semester" required>
        <optgroup label="Pilih Semester">
          <option value="<?= Input::val('semester'); ?>" hidden><?= (empty($_POST['semester'])) ? 'Pilih Semester' : $_POST['semester'].kateSemes($_POST['semester']); ?></option>
          <?php for ($i=1; $i <= 6 ; $i++) { ?>
            <option value="<?= $i; ?>"><?= $i; ?> & <?= kateSemes($i); ?></option>
          <?php } ?>
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
        $('#tampil').load('resource/views/semester/_show.php', {page: '<?= token(32); ?>'});
      });
      $("#tahunajaran").change( function() {
        $.ajax({
          type: "POST",
          url: "resource/views/semester/inc/_kode.php",
          data: {id: $("#id").val(), tahunajaran: $("#tahunajaran").val(), semester: $("#semester").val()},
          cache: false,
          dataType: "json",
          success: function(data) {
            $("#kode").attr("value", data.htmlkodeajaran);
            $("#showKode").html(data.htmlentities);
          }
        });
      });
      $("#semester").change( function() {
        $.ajax({
          type: "POST",
          url: "resource/views/semester/inc/_kode.php",
          data: {tahunajaran: $("#tahunajaran").val(), semester: $("#semester").val()},
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
          url: 'resource/views/semester/inc/_save.php',
          data: {kode: $('#kode').val(), tahunajaran: $('#tahunajaran').val(), semester: $('#semester').val()},
          cache: false,
          success: function(response) {
            $('#tampil').load('resource/views/semester/_show.php', {page: '<?= token(32); ?>'});
            changeurl('semester.php');
            return getMessages();
          }
        });
      });
    });
  </script>
<?php endif; ?>
