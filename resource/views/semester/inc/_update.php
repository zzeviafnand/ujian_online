
<?php
if (isset($_POST['id'])) {
  if ($_POST['id'] == $_POST['kode']) {
    $fields = ['kode_tahunajaran' => $_POST['tahunajaran'], 'kategori_semester' => $_POST['semester']];
  }else {
    $fields = ['kode_semester' => $_POST['kode'], 'kode_tahunajaran' => $_POST['tahunajaran'], 'kategori_semester' => $_POST['semester']];
  }
  require_once __DIR__.'/../../../../app/config.php';
  if ($db->table('semester')->where('kode_semester', $_POST['id'])->update($fields)) {
    $msg->success('Semester berhasil diperbarui');
  } else $msg->warning('Maaf, terjadi kesalahan saat memperbarui data');
}
?>
