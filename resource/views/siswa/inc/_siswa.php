<?php if (isset($_POST['kelas'])):

  require_once __DIR__.'/../../../../app/config.php';
  $fields = [
    'kelas' => 'siswa.kode_kelas = kelas.kode_kelas',
  ];
  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;
  $search = (isset($_POST['search'])) ? "%".$_POST['search']."%" : '';
  if ($_POST['kelas'] == 'all') {
    $posts = $db->table('siswa')->pagination($lenght, 1)->selfJoin($fields)->like('siswa.nama_siswa', "%".$search."%")->orderBy('nis_siswa')->get();
  } else {
    $posts = $db->table('siswa')->pagination($lenght, 1)->selfJoin($fields)->where('kelas.kode_kelas', $_POST['kelas'])->like('siswa.nama_siswa', $search)->orderBy('nis_siswa')->get();
  }
  if (is_array($posts)) {
    foreach ($posts as $key => $row) {
      ?>
      <tr id="table-<?= $row->nis_siswa; ?>">
        <td><?= $row->nis_siswa; ?></td>
        <td><?= $row->nama_siswa; ?></td>
        <td><?= $row->tempat_siswa.'/'.setdate($row->tanggal_siswa); ?></td>
        <td><?= gender($row->kelamin_siswa); ?></td>
        <td><?= $row->nama_kelas; ?></td>
        <td><?= $row->telepon_siswa; ?></td>
        <td><?= $row->username; ?></td>
        <td>
          <a onclick="changeurl('siswa.php?page=edit&id=<?= encode($row->nis_siswa); ?>');" id="edit<?= $row->nis_siswa; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"> Edit</a>
            <script type="text/javascript">
            $('#edit<?= $row->nis_siswa; ?>').click( function() {
              $('#tampil').load('resource/views/siswa/_edit.php', {id: '<?= encode($row->nis_siswa); ?>'});
            });
            </script>
            <a onclick="deleteRecord('resource/views/siswa/inc/_delete.php', <?= $row->nis_siswa; ?>);" class="btn btn-sm btn-warning"><span class="fa fa-trash-alt"> Delete</a>
            </td>
          </tr>
          <?php
        }
      }
      ?>

<?php endif; ?>
