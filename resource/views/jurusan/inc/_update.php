<?php
if (isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($_POST['id'] == $_POST['kode']) {
    $fields = ['nama_jurusan' => $_POST['nama'], 'register_petugas' => $_POST['petugas']];
  }else {
    $fields = ['kode_jurusan' => $_POST['kode'], 'nama_jurusan' => $_POST['nama'], 'register_petugas' => $_POST['petugas']];
  }
  if ($db->table('jurusan')->where('kode_jurusan', $_POST['id'])->update($fields)) {
    $msg->success('Data jurusan berhasil diperbarui');
  } else $msg->warning('Maaf, terjadi kesalahan saat memperbarui data');
}
?>
