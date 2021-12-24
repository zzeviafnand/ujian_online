<?php
require_once __DIR__.'/../../app/config.php';
if (isset($_SESSION['role_siswa'])) {
  foreach ($db->table('siswa')->select('nama_siswa')->where('username', $_SESSION['role_siswa'])->get() as $key => $value); ?>
<div class="sidenav-header-inner text-center">
	<!-- <img src="" alt="person" class="img-fluid rounded-circle fa fa-user"> -->
	<span class="img-fluid rounded-circle fa fa-user" style="font-size: 70px;"></span>
  <h2 class="h5"><?= $value->nama_siswa; ?></h2><span>Siswa</span>
</div>
  <?php
} elseif (isset($_SESSION['role_petugas'])) {
  foreach ($db->table('petugas')->select('nama_petugas, level_petugas')->where('register_petugas', $_SESSION['user_petugas'])->get() as $key => $value); ?>
<div class="sidenav-header-inner text-center">
  <!-- <img src="public/images/febrihidayan.jpg" alt="person" class="img-fluid rounded-circle"> -->
  <span class="img-fluid rounded-circle fa fa-user" style="font-size: 70px;"></span>
  <h2 class="h5"><?= $value->nama_petugas; ?></h2><span><?= level($value->level_petugas); ?></span>
</div>
  <?php
}
 ?>
