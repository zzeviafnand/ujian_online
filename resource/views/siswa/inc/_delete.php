<?php
if (isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('siswa')->where('nis_siswa', $_POST['id'])->delete()) {
    $msg->success('Data siswa berhasil terhapus');
  } else $msg->warning('Maaf, terjadi kesalahan saat menghapus data');
}
?>
