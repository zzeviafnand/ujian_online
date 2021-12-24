<?php
if (isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('semester')->where('kode_semester', $_POST['id'])->delete()) {
    $msg->success('Semester berhasil terhapus');
  } else $msg->warning('Maaf, terjadi kesalahan saat menghapus data');
}
?>
