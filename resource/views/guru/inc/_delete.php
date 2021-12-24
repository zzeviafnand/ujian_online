<?php
require_once __DIR__.'/../../../../app/config.php';
if ($db->table('petugas')->where('register_petugas', $_REQUEST['id'])->delete()) {
  $msg->success('Data guru berhasl terhapus');
} else $msg->warning('Maaf, terjadi kesalahan saat menghapus data');
?>
