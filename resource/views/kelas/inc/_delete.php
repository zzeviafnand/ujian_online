<?php
if (isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('kelas')->where('kode_kelas', $_POST['id'])->delete()) {
    $msg->success('Data kelas berhasil terhapus');
  } else $msg->warning('Maaf, terjadi kesalahan saat menghapus data');
}
?>
