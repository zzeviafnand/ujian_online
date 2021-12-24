<?php
if (isset($_POST['id']) && isset($_POST['username']) || isset($_POST['password'])) {
  require_once __DIR__.'/../../../../../app/config.php';
  if (!empty($_POST['password'])) {
    $fields = [
      'username' => $_POST['username'],
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    ];
  } else {
    $fields = [
      'username' => $_POST['username'],
    ];
  }
  if ($db->table('siswa')->where('nis_siswa', $_POST['id'])->update($fields)) {
    $msg->success('Data siswa berhasil diperbarui');
  } else $msg->warning('Maaf, terjadi kesalahan saat memperbarui data');
}
?>
