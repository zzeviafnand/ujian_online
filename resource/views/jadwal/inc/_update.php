<?php
if (isset($_POST['id'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $fields = [
    'nama_jadwal' => $_POST['nama'],
    'keterangan_jadwal' => $_POST['keterangan'],
    'tanggal_mulai_jadwal' => $_POST['tanggalMulai'],
    'tanggal_selesai_jadwal' => $_POST['tanggalSelesai'],
    'waktu_jadwal' => $_POST['waktu'],
    'id_kbm' => $_POST['mapel'],
    'kode_kelas' => $_POST['kelas'],
    'register_petugas' => $_SESSION['user_petugas'],
  ];
  if ($db->table('jadwal')->where('id_jadwal', $_POST['id'])->update($fields)) {
    $msg->success('Jadwal berhasil diperbarui');
  }
}
