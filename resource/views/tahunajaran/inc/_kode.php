<?php
if (isset($_POST['nama'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $kode = explode('/', $_POST['nama']);
  $kode = 'TA'.substr($kode[0], 2).substr((isset($kode[1])) ? $kode[1] : '', 2);
  $output = '';
  if (isset($_POST['id'])) {
    if ($kode != $_POST['id']) {
      if ($db->table('tahunajaran')->select('kode_tahunajaran')->where('kode_tahunajaran', $kode)->get() != 0) {
        $output = 'Maaf!, kode Ajaran sudah tersedia sebelumnya';
      }
    }
  } else {
    if ($db->table('tahunajaran')->select('kode_tahunajaran')->where('kode_tahunajaran', $kode)->get() != 0) {
      $output = 'Maaf!, kode Ajaran sudah tersedia sebelumnya';
    }
  }

  $data = [
    'htmlentities' => $output,
    'htmlkodeajaran' => $kode
  ];
  echo json_encode($data);
}
?>
