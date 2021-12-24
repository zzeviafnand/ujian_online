
<?php
require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('semester')->insert(['kode_semester' => $_POST['kode'], 'kode_tahunajaran' => $_POST['tahunajaran'], 'kategori_semester' => $_POST['semester']])) {
    $msg->success('Semester berhasil tersimpan');
  } else $msg->warning('Maaf, terjadi kesalahan saat menyimpan data');
?>
