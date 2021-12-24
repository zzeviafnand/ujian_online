<?php
if (isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('jadwal')->where('id_jadwal', $_POST['id'])->delete()) {
    $msg->success('Data jadwal berhasil terhapus');
  } else {
    $msg->warning('Maaf, terjadi kesalahan saat menghapus data');
  }
}
?>
