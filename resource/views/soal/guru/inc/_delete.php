<?php
require_once __DIR__.'/../../../../../app/config.php';
if ($db->table('soal')->where('id_soal', $_POST['id'])->delete()) {
  $msg->success('Soal berhasil terhapus');
} else $msg->warning('Maaf, terjadi kesalahan saat menghapus data');
?>
