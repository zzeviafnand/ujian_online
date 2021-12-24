<?php
if (isset($_POST['register'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $fields = [
    'register_petugas' => $_POST['register'],
    'nipk_petugas' => $_POST['nipk'],
    'nama_petugas' => $_POST['nama'],
    'tempat_petugas' => $_POST['tempat'],
    'tanggal_petugas' => $_POST['tahun'].'-'.$_POST['bulan'].'-'.$_POST['hari'],
    'kelamin_petugas' => $_POST['kelamin'],
    'telepon_petugas' => $_POST['telepon'],
    'alamat_petugas' => $_POST['alamat'],
    'level_petugas' => $_POST['level'],
    'password_petugas' => password_hash($_POST['tahun'].$_POST['bulan'].$_POST['hari'], PASSWORD_DEFAULT),
  ];
  if ($db->table('petugas')->insert($fields)) {
    $msg->success('Petugas berhasil tersimpan');
  } else $msg->warning('Maaf, terjadi kesalahan saat menyimpan data');
}
