<?php
if (isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('jurusan')->where('kode_jurusan', $_POST['id'])->delete()) {
    $msg->success('Data jurusan berhasl terhapus');
  } else $msg->warning('Maaf, terjadi kesalahan saat menghapus data');
}
?>
