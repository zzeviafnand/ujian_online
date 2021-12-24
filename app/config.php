<?php
ob_start();
session_start();
require_once __DIR__.'/../vendor/autoload.php';
require_once 'validation.php';
$msg = new Plasticbrain\FlashMessages\FlashMessages();
$db = new Basemodel\QueryBuilder\DB();
if (isset($_SESSION['role_siswa'])) {

} elseif (isset($_SESSION['role_petugas'])) {
  require_once 'automatic.php';
}else {
  if (!isset($_GET['login'])) {
    echo "<script>window.location.replace('login.php');</script>";
  }
}
