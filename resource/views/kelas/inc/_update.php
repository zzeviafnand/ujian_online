<?php
if (isset($_POST['nama']) && isset($_POST['jurusan']) && isset($_POST['petugas']) && isset($_POST['tahunajaran'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($_POST['kode'] == $_POST['id']) {
    $fields = [
      'nama_kelas' => $_POST['nama'],
      'kode_jurusan' => $_POST['jurusan'],
      'register_petugas' => $_POST['petugas'],
      'kode_tahunajaran' => $_POST['tahunajaran'],
    ];
  } else {
    $fields = [
      'kode_kelas' => $_POST['kode'],
      'nama_kelas' => $_POST['nama'],
      'kode_jurusan' => $_POST['jurusan'],
      'register_petugas' => $_POST['petugas'],
      'kode_tahunajaran' => $_POST['tahunajaran'],
    ];
  }

  if ($db->table('kelas')->where('kode_kelas', $_POST['id'])->update($fields)) {
    $msg->success('Data kelas berhasil diperbarui');
  } else $msg->warning('Maaf, terjadi kesalahan saat memperbarui data');
}
?>
