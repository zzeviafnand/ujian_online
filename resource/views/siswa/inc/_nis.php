<?php
if (isset($_POST['nis'])) {
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('siswa')->select('nis_siswa')->where('nis_siswa', $_POST['nis'])->get() != 0): ?>
    Maaf!, NIS yang dimasukan sudah terdaftar
  <?php endif; ?>
<?php }?>
