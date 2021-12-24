<?php if (isset($_POST['id'])):

  require_once __DIR__.'/../../../app/config.php';
  foreach ($db->table('tahunajaran')->where('kode_tahunajaran', decode($_POST['id']))->get() as $rows);

  $output = '
  <a id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <form class="was-validated" action="#" method="post">
    <input type="hidden" id="id" value="' .$rows->kode_tahunajaran. '">
    <div class="form-group">
      <label for="kode">Kode Ajaran</label>
      <input type="text" id="kode" class="form-control" value="' .$rows->kode_tahunajaran. '" required disabled>
      <div id="showKode"></div>
    </div>
    <div class="form-group">
      <label for="nama">Nama Tahun Ajaran</label>
      <input type="text" name="nama" id="nama" class="form-control" value="' .$rows->nama_tahunajaran. '" required>
    </div>
    <div class="form-group">
      <button type="submit" id="tambah" class="btn btn-sm btn-success btn-block"><span class="fa fa-edit"></span> Edit</button>
    </div>
  </form>
  <script type="text/javascript">
    $(document).ready( function() {
      $("#home").click( function() {
        changeurl("tahunajaran.php");
        $("#tampil").load("resource/views/tahunajaran/_show.php", {page: "' .token(32). '"});
      });
      $("#nama").on("keyup",  function() {
        $.ajax({
          type: "POST",
          url: "resource/views/tahunajaran/inc/_kode.php",
          data: {id: $("#id").val(), nama: $("#nama").val()},
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
          url: "resource/views/tahunajaran/inc/_update.php",
          data: {id: $("#id").val(), kode: $("#kode").val(), nama: $("#nama").val()},
          cache: false,
          success: function(response) {
            $("#tampil").load("resource/views/tahunajaran/_show.php", {page: "' .token(32). '"});
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

endif; ?>
