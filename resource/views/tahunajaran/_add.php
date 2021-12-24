
<?php
if (isset($_POST['page'])) {

  require_once __DIR__.'/../../../app/config.php';
  $output = '
  <a id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <form class="was-validated" method="post">
    <div class="form-group">
      <label for="kode">Kode Ajaran</label>
      <input type="text" id="kode" class="form-control" value="" required disabled>
      <div id="showKode"></div>
    </div>
    <div class="form-group">
      <label for="nama">Nama Tahun Ajaran</label>
      <input type="text" id="nama" class="form-control" value="" required>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-sm btn-success btn-block"><span class="fa fa-save"></span> Save</button>
    </div>
  </form>
  <script type="text/javascript">
    $(document).ready( function() {
      $("#error").hide();
      $("#home").click( function() {
        changeurl("tahunajaran.php");
        $("#tampil").load("resource/views/tahunajaran/_show.php", {page: "'. token(32) .'"});
      });
      $("#nama").on("keyup",  function() {
        $.ajax({
          type: "POST",
          url: "resource/views/tahunajaran/inc/_kode.php",
          data: {nama: $("#nama").val()},
          cache: false,
          dataType: "json",
          success: function(data) {
            $("#kode").attr("value", data.htmlkodeajaran);
            $("#showKode").html(data.htmlentities);
          }
        });
      });
      $("form").submit( function(event) {
        event.preventDefault();
        $.ajax({
          type: "POST",
          url: "resource/views/tahunajaran/inc/_save.php",
          data: {kode: $("#kode").val(), nama: $("#nama").val()},
          cache: false,
          success: function(data) {
            $("#tampil").load("resource/views/tahunajaran/_show.php", {page: "'. token(32) .'"});
            changeurl("tahunajaran.php");
            return getMessages();
          }
        });
      });
    });
  </script>
  ';

  $data = [
    'htmlentities' => $output,
  ];
  echo json_encode($data);

}
?>
