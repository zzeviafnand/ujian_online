<?php
if (isset($_POST['nis'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $pass = explode(' ', $_POST['nama']);
  $pass = $pass[0].$_POST['nis'];
  $fields = [
    'nis_siswa' => $_POST['nis'],
    'nama_siswa' => $_POST['nama'],
    'tempat_siswa' => $_POST['tempat'],
    'tanggal_siswa' => $_POST['tahun'].'-'.$_POST['bulan'].'-'.$_POST['hari'],
    'kelamin_siswa' => $_POST['kelamin'],
    'telepon_siswa' => $_POST['telepon'],
    'kode_kelas' => $_POST['kelas'],
    'username' => $_POST['username'],
    'password' => password_hash($pass, PASSWORD_DEFAULT),
  ];
  if ($db->table('siswa')->insert($fields)) {
    $msg->success('Data siswa berhasil tersimpan');
  } else $msg->warning('Maaf, terjadi kesalahan saat menyimpan data');
}
?>
