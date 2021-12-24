<?php
if (isset($_POST['nis']) && isset($_POST['column']) && isset($_POST['status'])) {

  require_once __DIR__.'/../../../../../app/config.php';
  foreach ($db->table('siswa')->select('pengaturan_siswa')->where('nis_siswa', $_POST['nis'])->get() as $key => $value);
  $set = explode(':', $value->pengaturan_siswa);
  $column = $_POST['column'];
  $status = ($_POST['status'] != 1) ? 0 : 1;

  if ($column == 4) {
    $field = $set[0].':'.$set[1].':'.$set[2].':'.$set[3].':'.$status.':'.$set[5];
  }else {
    $field = $set[0].':'.$set[1].':'.$set[2].':'.$set[3].':'.$set[4].':'.$status;
  }

  $db->table('siswa')->where('nis_siswa', $_POST['nis'])->update(['pengaturan_siswa' => $field]);

  // Status kebalikannya karena nilai sudah dibalik
  if ($status == 1) {
    echo '<span class="fa fa-toggle-on"></span> Nonaktif';
  } else {
    echo '<span class="fa fa-toggle-off"></span> Aktif';
  }

}
?>
