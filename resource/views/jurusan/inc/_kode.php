<?php
if (isset($_POST['nama'])) {
  require_once __DIR__.'/../../../../app/config.php';
  
  $kode = explode(' ', $_POST['nama']);
  $field1 = '';
  for ($i=0; $i < count($kode); $i++) {
    $line = strlen($kode[$i])-1;
    if (strlen($kode[$i]) == 1) {
      $field1 .= sprintf('%s', substr($kode[$i], 0));
    } else {
      $field1 .= sprintf('%s', substr($kode[$i], 0, -$line));
    }
  }

  $kode = $field1.'01';

  $output = '';
  if (isset($_POST['id'])) {
    if ($kode != $_POST['id']) {
      if ($db->table('jurusan')->select('kode_jurusan')->where('kode_jurusan', $kode)->get() != 0) {
        $output = 'Maaf!, kode Jurusan '.$kode.' sudah tersedia sebelumnya';
      }
    }
  } else {
    if ($db->table('jurusan')->select('kode_jurusan')->where('kode_jurusan', $kode)->get() != 0) {
      $output = 'Maaf!, kode Jurusan '.$kode.' sudah tersedia sebelumnya';
    }
  }

  $data = [
    'htmlentities' => $output,
    'htmlkodeajaran' => $kode
  ];
  echo json_encode($data);
}
?>
