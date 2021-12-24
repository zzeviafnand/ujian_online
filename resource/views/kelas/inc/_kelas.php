
<?php
if (isset($_POST['tahunajaran']) && isset($_POST['jurusan'])) {

  require_once __DIR__.'/../../../../app/config.php';
  $no = 1;
  $fields = [
    'petugas' => 'petugas.register_petugas = kelas.register_petugas',
    'jurusan' => 'jurusan.kode_jurusan = kelas.kode_jurusan',
    'tahunajaran' => 'tahunajaran.kode_tahunajaran = kelas.kode_tahunajaran',
  ];
  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;
  $search = (isset($_POST['search'])) ? $_POST['search'] : '';
  if ($_POST['jurusan'] == 'all' && $_POST['tahunajaran'] == 'all') {
    $posts = $db->table('kelas')->pagination($lenght, 1)->selfJoin($fields)->like('petugas.nama_petugas', "%".$search."%")->orderBy('nama_kelas')->get();
  } elseif ($_POST['jurusan'] == 'all') {
    $posts = $db->table('kelas')->pagination($lenght, 1)->selfJoin($fields)->where('tahunajaran.kode_tahunajaran', $_POST['tahunajaran'])->like('petugas.nama_petugas', "%".$search."%")->orderBy('nama_kelas')->get();
  } elseif ($_POST['tahunajaran'] == 'all') {
    $posts = $db->table('kelas')->pagination($lenght, 1)->selfJoin($fields)->where('jurusan.kode_jurusan', $_POST['jurusan'])->like('petugas.nama_petugas', "%".$search."%")->orderBy('nama_kelas')->get();
  } else {
    if (isset($_POST['search'])) {
      $posts = $db->table('kelas')->pagination($lenght, 1)->selfJoin($fields)->where('jurusan.kode_jurusan = ? AND tahunajaran.kode_tahunajaran = ?', [$_POST['jurusan'], $_POST['tahunajaran']])->like('petugas.nama_petugas', "%".$search."%")->orderBy('nama_kelas')->get();
    } else {
      $posts = $db->table('kelas')->pagination($lenght, 1)->selfJoin($fields)->orderBy('nama_kelas')->get();
    }
  }
  // $posts = $db->table('kelas')->pagination(10, 1)->selfJoin($fields)->orderBy('nama_kelas')->get();
  if (is_array($posts)) {
    foreach ($posts as $key => $row) { ?>
<tr id="table-<?= $row->kode_kelas; ?>">
  <td><?= $no++; ?></td>
  <td><?= $row->kode_kelas; ?></td>
  <td><?= $row->nama_kelas; ?></td>
  <td><?= $row->nama_petugas; ?></td>
  <td><?= $row->nama_tahunajaran; ?></td>
  <td><?= $row->nama_jurusan; ?></td>
  <td>
    <a onclick="changeurl('kelas.php?page=edit&id=<?= encode($row->kode_kelas); ?>');" id="edit<?= $row->kode_kelas; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"> Edit</a>
      <a onclick="deleteRecord('resource/views/kelas/inc/_delete.php', '<?= $row->kode_kelas; ?>');" class="btn btn-sm btn-warning"><span class="fa fa-trash-alt"> Delete</a>
      </td>
    </tr>
    <script type="text/javascript">
    $('#edit<?= $row->kode_kelas; ?>').click( function() {
      $('#tampil').load('resource/views/kelas/_edit.php', {id: '<?= encode($row->kode_kelas); ?>'});
    });
    </script>
  <?php }}} ?>
