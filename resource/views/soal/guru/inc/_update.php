
<?php
require_once __DIR__.'/../../../../app/config.php';
if ($db->table('mapel')->where('id_mapel', $_REQUEST['id'])->update(['nama_mapel' => $_REQUEST['nama']])) {
  $msg->success('Soal berhasil diperbarui');
} else $msg->warning('Maaf, terjadi kesalahan saat memperbarui data');
?>
