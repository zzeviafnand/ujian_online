<?php
if (isset($_POST['rows'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $no = 1;

  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;
  $search = (isset($_POST['search'])) ? "%".$_POST['search']."%" : '%%';
  $posts = $db->table('mapel')->pagination($lenght, 1)->like('nama_mapel', $search)->orderBy('nama_mapel')->get();
  if (is_array($posts)) {
    foreach ($posts as $key => $row) { ?>
  <tr id="table-<?= $row->id_mapel; ?>">
  <td><?= $no++; ?></td>
  <td><?= $row->nama_mapel; ?></td>
  <td><?= kateMapel($row->kategori_mapel); ?></td>
  <td><?= $row->kkm_mapel; ?></td>
  <td>
    <a onclick="changeurl('mapel.php?page=edit&id=<?= encode($row->id_mapel); ?>');" id="edit<?= $row->id_mapel; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"> Edit</a>
      <a onclick="deleteRecord('resource/views/mapel/inc/_delete.php', <?= $row->id_mapel; ?>);" class="btn btn-sm btn-warning" onclick="return confirm('Anda yakin ingin menghapus data tersebut?');"><span class="fa fa-trash-alt"> Delete</a>
      </td>
    </tr>
    <script type="text/javascript">
    $('#edit<?= $row->id_mapel; ?>').click( function() {
      $('#tampil').load('resource/views/mapel/_edit.php', {id: '<?= encode($row->id_mapel); ?>'});
    });
  </script>
<?php }}} ?>
