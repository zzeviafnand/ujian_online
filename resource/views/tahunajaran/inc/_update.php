<?php
if (isset($_POST['kode'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($_POST['id'] == $_POST['kode']) {
    $fields = ['nama_tahunajaran' => $_POST['nama']];
  }else {
    $fields = ['kode_tahunajaran' => $_POST['kode'], 'nama_tahunajaran' => $_POST['nama']];
  }
  if ($db->table('tahunajaran')->where('kode_tahunajaran', $_POST['id'])->update($fields)) {
    $msg->success('Data tahun ajaran berhasil diperbarui');
  } else $msg->warning('Maaf, terjadi kesalahan saat memperbarui data');
}
?>
