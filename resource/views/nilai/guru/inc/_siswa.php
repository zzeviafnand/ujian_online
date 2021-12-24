<?php
require_once __DIR__.'/../../../../../app/config.php';
if (isset($_POST['search']) && isset($_POST['mapel'])) {
  $fields = [
    'kelas' => 'kelas.kode_kelas = siswa.kode_kelas',
    'jadwal' => 'jadwal.kode_kelas = kelas.kode_kelas',
    'kbm' => 'kbm.id_kbm = jadwal.id_kbm',
    'mapel' => 'mapel.id_mapel = kbm.id_mapel'
  ];

  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;
  $search = (isset($_POST['search'])) ? "%".$_POST['search']."%" : '';
  if ($_POST['mapel'] == 'all') {
    $posts = $db->table('siswa')->pagination($lenght, 1)->selfJoin($fields)->where('kelas.register_petugas', $_SESSION['user_petugas'])->like('siswa.nama_siswa', $search)->orderBy('nis_siswa')->get();
  } else {
    $posts = $db->table('siswa')->pagination($lenght, 1)->selfJoin($fields)->where('kelas.register_petugas = ? AND mapel.id_mapel = ?', [$_SESSION['user_petugas'], $_POST['mapel']])->like('siswa.nama_siswa', $search)->orderBy('nis_siswa')->get();
  }
  if (is_array($posts)) {
    foreach ($posts as $key => $row) {?>
<tr>
 <td><?= $row->nis_siswa; ?></td>
 <td><?= $row->nama_siswa; ?></td>
 <td><?= $row->nama_mapel; ?></td>
 <td><?= $row->kkm_mapel; ?></td>
 <td>
   <?php
     $field = [
       'kbm' => 'kbm.id_kbm = jadwal.id_kbm',
       'jadwal' => 'jadwal.id_jadwal = jawab.id_jadwal',
     ];
     $post = $db->table('jawab')->selfJoin($field)->where('nis_siswa = ? AND id_mapel = ?', [$row->nis_siswa, $row->id_mapel])->get();
     if (is_array($post)) {
       $nilai = 0;
       foreach ($post as $key => $jawab) {
         if ($jawab->hasil_jawab == 1) {
           foreach ($db->table('soal')->select('skor_soal')->where('id_soal', $jawab->id_soal)->get() as $key => $soal);
           $nilai = $nilai + $soal->skor_soal;
         }
       }
       echo $nilai;
     } else {
       echo "Menunggu";
     }
   ?>
 </td>
</tr>
<?php }
}
} ?>
