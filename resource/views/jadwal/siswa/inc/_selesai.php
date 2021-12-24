<?php
if (isset($_POST['selesai'])) {
  require_once __DIR__.'/../../../../../app/config.php';
  if (decode($_POST['selesai']) == $_SESSION['role_siswa']) {
    $db->table('siswa')->where('nis_siswa', $_SESSION['role_siswa'])->update(['pengaturan_siswa' => null]);
    setCookie('waktu', null, -1, '/');
    setCookie('jadwal', null, -1, '/');
    echo "<script>window.location.replace('jadwal.php');</script>";
  }?>
  <?php
}
 ?>
