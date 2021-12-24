<?php
if (isset($_POST['nis'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $fields = [
    'nis_siswa' => $_POST['nis'],
    'nama_siswa' => $_POST['nama'],
    'tempat_siswa' => $_POST['tempat'],
    'tanggal_siswa' => $_POST['tahun'].'-'.$_POST['bulan'].'-'.$_POST['hari'],
    'kelamin_siswa' => $_POST['kelamin'],
    'telepon_siswa' => $_POST['telepon'],
    'kode_kelas' => $_POST['kelas'],
    'username' => $_POST['username'],
  ];
  if ($db->table('siswa')->where('nis_siswa', $_POST['id'])->update($fields)) {
    $msg->success('Data siswa berhasil diperbarui');
  } else $msg->warning('Maaf, terjadi kesalahan saat memperbarui data');
}
?>
