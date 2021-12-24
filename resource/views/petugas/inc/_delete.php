<?php
if (isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('petugas')->where('register_petugas', $_POST['id'])->delete()) {
    $msg->success('Data petugas berhasil terhapus');
  } else $msg->warning('Maaf, terjadi kesalahan saat menghapus data');
}
?>
