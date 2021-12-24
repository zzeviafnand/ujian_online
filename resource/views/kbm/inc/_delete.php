<?php
if (isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('kbm')->where('id_kbm', $_POST['id'])->delete()) {
    $msg->success('Data kbm berhasil terhapus');
  } else $msg->warning('Maaf, terjadi kesalahan saat menghapus data');
}
?>
