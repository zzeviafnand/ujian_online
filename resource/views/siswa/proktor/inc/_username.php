<?php
if (isset($_POST['username'])) {
  require_once __DIR__.'/../../../../../app/config.php';
  if ($_POST['username'] != $_POST['id']) {
    if ($db->table('siswa')->select('username')->where('username', $_POST['username'])->get() != 0) {
      echo "Maaf!, Username sudah digunkan oleh Siswa lain";
    }
  }
}
