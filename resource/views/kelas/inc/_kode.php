<?php
if (isset($_POST['nama'])) {
  require_once __DIR__.'/../../../../app/config.php';

  $int = (int)$_POST['nama'];
  $kodeAwal = str_replace($int, '', $_POST['nama']).$int.'1';
  $kodeNew = '';
  $output = '';
  if (isset($_POST['id'])) {
    if ($kodeAwal != $_POST['id']) {
      if ($db->table('kelas')->select('kode_kelas')->where('kode_kelas', $kodeAwal)->get() != 0) {
        $kodeNewRows = strlen($kodeAwal)-1;
        $kodeNew = substr($kodeAwal, $kodeNewRows)+1;
        $kodeNew = substr($kodeAwal, 0, $kodeNewRows).$kodeNew;
        $output = 'Maaf!, kode Kelas '.$kodeAwal.' sudah tersedia sebelumnya. <br> Sehingga sistem akan mengubanya manjadi '.$kodeNew;
      }
    }
  } else {
    if ($db->table('kelas')->select('kode_kelas')->where('kode_kelas', $kodeAwal)->get() != 0) {
      $kodeNewRows = strlen($kodeAwal)-1;
      $kodeNew = substr($kodeAwal, $kodeNewRows)+1;
      $kodeNew = substr($kodeAwal, 0, $kodeNewRows).$kodeNew;
      $output = 'Maaf!, kode Kelas '.$kodeAwal.' sudah tersedia sebelumnya. <br> Sehingga sistem akan mengubanya manjadi '.$kodeNew;
    }
  }
  $kode = ($kodeNew == '') ? $kodeAwal : $kodeNew;
  $data = [
    'htmlentities' => $output,
    'htmlkodeajaran' => $kode
  ];
  echo json_encode($data);
}
?>
