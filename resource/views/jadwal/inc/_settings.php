<?php
if (isset($_POST['id']) && isset($_POST['column']) && isset($_POST['status'])) {
  require_once __DIR__.'/../../../../app/config.php';

  foreach ($db->table('jadwal')->where('id_jadwal', $_POST['id'])->get() as $key => $value);
  $set = explode(':', $value->pengaturan_jadwal);
  $column = $_POST['column'];
  $status = ($_POST['status'] != 1) ? 0 : 1;

  if ($column == 0) {
    $fields = [
      'pengaturan_jadwal' => $status.':'.$set[1].':'.$set[2]
    ];
  }elseif ($column == 1) {
    $fields = [
      'pengaturan_jadwal' => $set[0].':'.$status.':'.$set[2]
    ];
  }else {
    $fields = [
      'pengaturan_jadwal' => $set[0].':'.$set[1].':'.$status
    ];
  }
  $db->table('jadwal')->where('id_jadwal', $_POST['id'])->update($fields);

  // Status kebalikannya karena nilai sudah dibalik
  if ($status == 1) {
    echo '<span class="fa fa-toggle-on"></span> Nonaktif';
  } else {
    echo '<span class="fa fa-toggle-off"></span> Aktif';
  }
}

?>
