<?php
if (isset($_POST['id'])) {
require_once __DIR__.'/../../../../app/config.php';
foreach ($db->table('siswa')->where('nis_siswa', decode($_POST['id']))->get() as $keys => $rows);
?>
<a onclick="changeurl('siswa.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
<p></p>
<form class="was-validated" action="" method="post">
  <input type="hidden" id="id" value="<?= $rows->nis_siswa; ?>">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" value="<?= $rows->username; ?>" class="form-control" required>
    <div id="showUsername"></div>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="text" name="password" id="password" value="" class="form-control">
    <div>Harus hati-hati saat melakukan penggantian password</div>
    <div>Cukup biarkan saja kosong, saat diperbarui</div>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-sm btn-success btn-block" value="Edit">
  </div>
</form>
<script type="text/javascript">
  $(document).ready( function() {
    $('#home').click( function() {
      $('#tampil').load('resource/views/siswa/proktor/_show.php');
    });
    $("#username").on("keyup", function() {
      $.ajax({
        type: 'POST',
        url: 'resource/views/siswa/proktor/inc/_username.php',
        data: {
          id: $('#id').val(),
          username: $('#username').val()
        },
        cache: false,
        success: function(data) {
          $('#showUsername').html(data);
        }
      });
    });
    $('form').submit( function(e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'resource/views/siswa/proktor/inc/_update.php',
        data: {
          id: $('#id').val(),
          username: $('#username').val(),
          password: $('#password').val()
        },
        cache: false,
        success: function(data) {
          $('#tampil').load('resource/views/siswa/proktor/_show.php');
        }
      });
    });
  });
</script>
<?php } ?>
