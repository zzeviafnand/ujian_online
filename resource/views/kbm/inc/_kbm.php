<?php
if (isset($_POST['tahunajaran']) && isset($_POST['mapel'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $no = 1;
  $fields = [
    'tahunajaran' => 'tahunajaran.kode_tahunajaran = semester.kode_tahunajaran',
    'semester' => 'semester.kode_semester = kbm.kode_semester',
    'mapel' => 'mapel.id_mapel = kbm.id_mapel',
    'petugas' => 'petugas.register_petugas = kbm.register_petugas',
  ];
  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;
  $search = (isset($_POST['search'])) ? $_POST['search'] : '';
  if ($_POST['mapel'] == 'all' && $_POST['tahunajaran'] == 'all') {
    $posts = $db->table('kbm')->pagination($lenght, 1)->selfJoin($fields)->like('petugas.nama_petugas', "%".$search."%")->orderBy('nama_tahunajaran')->get();
  } elseif ($_POST['mapel'] == 'all') {
    $posts = $db->table('kbm')->pagination($lenght, 1)->selfJoin($fields)->where('tahunajaran.kode_tahunajaran', $_POST['tahunajaran'])->like('petugas.nama_petugas', "%".$search."%")->orderBy('nama_tahunajaran')->get();
  } elseif ($_POST['tahunajaran'] == 'all') {
    $posts = $db->table('kbm')->pagination($lenght, 1)->selfJoin($fields)->where('mapel.id_mapel', $_POST['mapel'])->like('petugas.nama_petugas', "%".$search."%")->orderBy('nama_tahunajaran')->get();
  } else {
    if (isset($_POST['search'])) {
      $posts = $db->table('kbm')->pagination($lenght, 1)->selfJoin($fields)->where('mapel.id_mapel = ? AND tahunajaran.kode_tahunajaran = ?', [$_POST['mapel'], $_POST['tahunajaran']])->like('petugas.nama_petugas', "%".$search."%")->orderBy('nama_tahunajaran')->get();
    } else {
      $posts = $db->table('kbm')->pagination($lenght, 1)->selfJoin($fields)->orderBy('nama_tahunajaran')->get();
    }
  }
  var_dump($posts);
  if (is_array($posts)) {
    foreach ($posts as $key => $row) { ?>
<tr id="table-<?= $row->id_kbm; ?>">
  <td><?= $no++; ?></td>
  <td><?= $row->nama_tahunajaran; ?></td>
  <td><?= $row->kategori_semester; ?>/<?= kateSemes($row->kategori_semester); ?></td>
  <td><?= $row->nama_mapel; ?></td>
  <td><?= $row->nama_petugas; ?></td>
  <td>
    <a onclick="changeurl('kbm.php?page=edit&id=<?= encode($row->id_kbm); ?>');" id="edit<?= $row->id_kbm; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"> Edit</a>
      <a onclick="deleteRecord('resource/views/kbm/inc/_delete.php', <?= $row->id_kbm; ?>);" class="btn btn-sm btn-warning"><span class="fa fa-trash-alt"> Delete</a>
      </td>
    </tr>
    <script type="text/javascript">
    $('#edit<?= $row->id_kbm; ?>').click( function() {
      $('#tampil').load('resource/views/kbm/_edit.php', {id: '<?= encode($row->id_kbm); ?>'});
    });
    </script>
  <?php }}} ?>
