<?php
if (isset($_POST['kelas'])) {
  require_once __DIR__.'/../../../../app/config.php';
  parse_str($_POST['kelas'],$kelas);
  foreach ($kelas as $key => $value) {
    for ($i=0; $i < count($value); $i++) {
      $fields = [
        'nama_jadwal' => $_POST['nama'],
        'keterangan_jadwal' => $_POST['keterangan'],
        'tanggal_mulai_jadwal' => $_POST['tanggalMulai'],
        'tanggal_selesai_jadwal' => $_POST['tanggalSelesai'],
        'waktu_jadwal' => $_POST['waktu'],
        'status_jadwal' => 0,
        'pengaturan_jadwal' => '0:0:0',
        'id_kbm' => $_POST['mapel'],
        'kode_kelas' => $value[$i],
        'register_petugas' => $_SESSION['user_petugas'],
      ];
      if ($db->table('jadwal')->insert($fields)) {
        $msg->success('Jadwal berhasil tersimpan');
      } else $msg->warning('Maaf, terjadi kesalahan saat menyimpan data');
    }
  }
  // $db->table('jadwal')->insert($fields);
}
