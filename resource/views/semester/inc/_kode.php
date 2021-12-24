<?php
if (isset($_POST['tahunajaran'])) {
  require_once __DIR__.'/../../../../app/config.php';
  
  $kode = ($_POST['tahunajaran'] != '' && $_POST['semester'] != '') ? 'TAS'.substr($_POST['tahunajaran'], 2).$_POST['semester'] : '';

  $output = '';
  if (isset($_POST['id'])) {
    if ($kode != $_POST['id']) {
      if ($db->table('semester')->select('kode_semester')->where('kode_semester', $kode)->get() != 0) {
        $output = 'Maaf!, kode Semester '.$kode.' sudah tersedia sebelumnya';
      }
    }
  } else {
    if ($db->table('semester')->select('kode_semester')->where('kode_semester', $kode)->get() != 0) {
      $output = 'Maaf!, kode Semester '.$kode.' sudah tersedia sebelumnya';
    }
  }

  $data = [
    'htmlentities' => $output,
    'htmlkodeajaran' => $kode
  ];
  echo json_encode($data);
}
?>
