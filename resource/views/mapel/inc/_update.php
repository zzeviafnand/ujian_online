<?php
if (isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('mapel')->where('id_mapel', $_POST['id'])->update(['nama_mapel' => $_POST['nama'], 'kategori_mapel' => $_POST['kategori'], 'kkm_mapel' => $_POST['kkm']])) {
    $msg->success('Data mapel berhasil diperbarui');
  } else $msg->warning('Maaf, terjadi kesalahan saat memperbarui data');
}
?>
