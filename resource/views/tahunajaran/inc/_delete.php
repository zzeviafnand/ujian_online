<?php
if (isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('tahunajaran')->where('kode_tahunajaran', $_POST['id'])->delete()) {
    $msg->success('Tahun ajaran berhasil terhapus');
  } else $msg->warning('Maaf, terjadi kesalahan saat menghapus data');
}
?>
