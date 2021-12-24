<?php
if (isset($_POST['soal']) && isset($_POST['soaljawab']) && isset($_POST['siswa'])) {
  require_once __DIR__.'/../../../../../app/config.php';
  $siswa = decode($_POST['siswa']);
  $soal = decode($_POST['soal']);
  $jawab = $_POST['soaljawab'];
  $jadwal = decode($_COOKIE['jadwal']);
  // echo $jadwal;
  foreach ($db->table('jawab')->select('id_soaljawab')->where('nis_siswa = ? AND id_jadwal = ? AND id_soal = ?', [$siswa, $jadwal, $soal])->get() as $key => $value) {
    if ($value->id_soaljawab == null) {
      $field = [
        'id_soal' => $soal,
        'text_soaljawab' => $jawab
      ];
      $db->table('soaljawab')->insert($field);
      $db->table('jawab')->where('nis_siswa = ? AND id_jadwal = ? AND id_soal = ?', [$siswa, $jadwal, $soal])->update(['id_soaljawab' => $db->insert_id(), 'hasil_jawab' => 4]);
    }else {
      if ($jawab == '') {
        foreach ($db->table('jawab')->select('id_soaljawab, id')->where('nis_siswa = ? AND id_jadwal = ? AND id_soal = ?', [$siswa, $jadwal, $soal])->get() as $key => $value)
        $db->table('soaljawab')->where('id_soaljawab', $value->id_soaljawab)->update(['text_soaljawab' => $jawab]);
        $db->table('jawab')->where('id', $value->id)->update(['hasil_jawab' => 0]);
      } else {
        foreach ($db->table('jawab')->select('id_soaljawab, id')->where('nis_siswa = ? AND id_jadwal = ? AND id_soal = ?', [$siswa, $jadwal, $soal])->get() as $key => $value)
        $db->table('soaljawab')->where('id_soaljawab', $value->id_soaljawab)->update(['text_soaljawab' => $jawab]);
        $db->table('jawab')->where('id', $value->id)->update(['hasil_jawab' => 4]);
      }

    }
  }
}
