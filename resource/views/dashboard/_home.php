<?php
require_once __DIR__.'/../../../app/config.php';
if (isset($_SESSION['role_siswa'])) {
  require_once '_siswa.php';
} elseif (isset($_SESSION['role_petugas'])) {
  $s = $_SESSION['role_petugas'];
  if ($s == 1) {
    require_once '_administrator.php';
  }elseif ($s == 2) {
    require_once '_staf.php';
  }elseif ($s == 3) {
    require_once '_guru.php';
  }else {
    require_once '_proktor.php';
  }
}
