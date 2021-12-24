<?php
if (isset($_POST['semester']) && isset($_POST['mapel']) && isset($_POST['guru']) && isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $fields = [
    'kode_semester' => $_POST['semester'],
    'id_mapel' => $_POST['mapel'],
    'register_petugas' => $_POST['guru'],
  ];
  if ($db->table('kbm')->where('id_kbm', $_POST['id'])->update($fields)) {
    $msg->success('Data kbm berhasil diperbarui');
  } else $msg->warning('Maaf, terjadi kesalahan saat memperbarui data');
}
?>
