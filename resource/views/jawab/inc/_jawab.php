<?php if (isset($_POST['kelas'])): ?>
  <?php
  require_once __DIR__.'/../../../../app/config.php';
  $fields = [
    'kelas' => 'kelas.kode_kelas = siswa.kode_kelas',
    'kbm' => 'kbm.id_kbm = jadwal.id_kbm',
    'jadwal' => 'kelas.kode_kelas = jadwal.kode_kelas',
  ];
  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;
  $search = (isset($_POST['search'])) ? "%".$_POST['search']."%" : '';
  if ($_POST['kelas'] == 'all') {
    $posts = $db->table('siswa')->pagination($lenght, 1)->selfJoin($fields)->where('kbm.register_petugas', $_SESSION['user_petugas'])->like('siswa.nama_siswa', $search)->orderBy('nis_siswa')->get();
  } else {
    $posts = $db->table('siswa')->pagination($lenght, 1)->selfJoin($fields)->where('kbm.register_petugas = ? AND kelas.kode_kelas = ?', [$_SESSION['user_petugas'], $_POST['kelas']])->like('siswa.nama_siswa', $search)->orderBy('nis_siswa')->get();
  }
  if (is_array($posts)) {
    foreach ($posts as $key => $row) { ?>
    <tr>
      <td><?= $row->nis_siswa; ?></td>
      <td><?= $row->nama_siswa; ?></td>
      <td><?= $row->nama_kelas; ?></td>
      <td>
        <?php $post = $db->table('jawab')->join('jadwal', 'jadwal.id_jadwal', '=', 'jawab.id_jadwal')->where('nis_siswa = ? AND id_kbm = ?', [$row->nis_siswa, $row->id_kbm])->get();
        if (is_array($post)) {?>
            <a onclick="changeurl('jawab.php?page=show&id=<?= encode($row->nis_siswa); ?>');" id="edit<?= $row->nis_siswa; ?>" class="btn btn-sm btn-info"><span class="fa fa-search-plus"> Show</a>
            <script type="text/javascript">
            $('#edit<?= $row->nis_siswa; ?>').click( function() {
              $('#tampil').load('resource/views/jawab/_detail.php', {id: '<?= encode($row->nis_siswa); ?>'});
            });
            </script>
            <?php
          } else {
            echo "Menunggu";
          }
          ?>
        </td>
      </tr>
      <?php
    }
  }
  ?>
<?php endif; ?>
