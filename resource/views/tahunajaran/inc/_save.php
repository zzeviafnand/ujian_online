<?php
if (isset($_POST['kode'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('tahunajaran')->insert(['kode_tahunajaran' => $_POST['kode'], 'nama_tahunajaran' => $_POST['nama']])) {
    $msg->success('Tahun ajaran berhasil tersimpan');
  } else $msg->warning('Maaf, terjadi kesalahan saat menyimpan data');
}
?>
