<?php
if (isset($_POST['semester']) && isset($_POST['mapel']) && isset($_POST['guru'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $fields = [
    'kode_semester' => $_POST['semester'],
    'id_mapel' => $_POST['mapel'],
    'register_petugas' => $_POST['guru'],
  ];
  if ($db->table('kbm')->insert($fields)) {
    $msg->success('Data kbm berhasil tersimpan');
  } else $msg->warning('Maaf, terjadi kesalahan saat menyimpan data');
}
?>
