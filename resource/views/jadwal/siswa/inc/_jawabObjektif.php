<?php
if (isset($_POST['soal']) && isset($_POST['soaljawab']) && isset($_POST['siswa'])) {
  require_once __DIR__.'/../../../../../app/config.php';
  $siswa = decode($_POST['siswa']);
  $soal = decode($_POST['soal']);
  $jawab = decode($_POST['soaljawab']);
  foreach ($db->table('soaljawab')->select('kunci_soaljawab')->where('id_soal = ? AND id_soaljawab = ?', [$soal, $jawab])->get() as $key => $soaljawab);
  if ($soaljawab->kunci_soaljawab == 1) {
    $db->table('jawab')->where('nis_siswa = ? AND id_soal = ?', [$siswa, $soal])->update(['hasil_jawab' => 1, 'id_soaljawab' => $jawab]);
  } else {
    $db->table('jawab')->where('nis_siswa = ? AND id_soal = ?', [$siswa, $soal])->update(['hasil_jawab' => 2, 'id_soaljawab' => $jawab]);
  }
}
