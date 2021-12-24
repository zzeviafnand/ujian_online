<?php
if (isset($_POST['kode'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('jurusan')->insert(['kode_jurusan' => $_POST['kode'], 'nama_jurusan' => $_POST['nama'], 'register_petugas' => $_POST['petugas']])) {
    $msg->success('Data jurusan berhasil tersimpan');
  } else $msg->warning('Maaf, terjadi kesalahan saat menyimpan data');
}
?>
