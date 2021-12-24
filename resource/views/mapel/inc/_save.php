<?php
if (isset($_POST['nama'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('mapel')->insert(['nama_mapel' => $_POST['nama'], 'kategori_mapel' => $_POST['kategori'], 'kkm_mapel' => $_POST['kkm']])) {
    $msg->success('Data mapel berhasil tersimpan');
}
  } else $msg->warning('Maaf, terjadi kesalahan saat menyimpan data');
?>
