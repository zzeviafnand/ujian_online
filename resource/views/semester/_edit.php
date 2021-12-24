<?php if (isset($_POST['id'])): ?>
  <?php
  require_once __DIR__.'/../../../app/config.php';
  foreach ($db->table('semester')->join('tahunajaran', 'tahunajaran.kode_tahunajaran', '=', 'semester.kode_tahunajaran')->where('kode_semester', decode($_POST['id']))->get() as $rows);
  ?>
  <a onclick="changeurl('semester.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <form class="was-validated" action="#" method="post">
    <input type="hidden" id="id" value="<?= $rows->kode_semester; ?>">
    <div class="form-group">
      <label for="kode">Kode Semester</label>
      <input type="text" id="kode" class="form-control" value="<?= $rows->kode_semester; ?>" required disabled>
      <div id="showKode"></div>
    </div>
    <div class="form-group">
      <label for="tahunajaran">Tahun Ajaran</label>
      <select class="form-control" name="tahunajaran" id="tahunajaran">
        <optgroup label="Pilih Tahun Ajaran">
          <option value="<?= $rows->kode_tahunajaran; ?>" hidden><?= $rows->nama_tahunajaran; ?></option>
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
          <option value="<?= $rows->kategori_semester; ?>" hidden><?= $rows->kategori_semester; ?> & <?= kateSemes($rows->kategori_semester); ?></option>
          <?php for ($i=1; $i <= 6 ; $i++) { ?>
            <option value="<?= $i; ?>"><?= $i; ?> & <?= kateSemes($i); ?></option>
          <?php } ?>
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
          data: {id: $("#id").val(), tahunajaran: $("#tahunajaran").val(), semester: $("#semester").val()},
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
          url: 'resource/views/semester/inc/_update.php',
          data: {id: $('#id').val(), kode: $('#kode').val(), tahunajaran: $('#tahunajaran').val(), semester: $('#semester').val()},
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
