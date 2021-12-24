<?php
if (isset($_POST['id']) && isset($_POST['status'])) {
  require_once __DIR__.'/../../../../app/config.php';

  $db->table('jadwal')->where('id_jadwal', $_POST['id'])->update(['status_jadwal' => $_POST['status']]);

  if ($_POST['status'] == 1) {
    echo '<span class="fa fa-toggle-on"></span> Nonaktif';
  } else {
    echo '<span class="fa fa-toggle-off"></span> Aktif';
  }
}

?>
