<?php
if (isset($_POST['rows'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $no = 1;

  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;
  $search = (isset($_POST['search'])) ? $_POST['search'] : '';
  $posts = $db->table('petugas')->pagination($lenght, 1)->like('petugas.nama_petugas', "%".$search."%")->where('level_petugas', 3)->orderBy('register_petugas')->get();

  if (is_array($posts)) {
    foreach ($posts as $key => $row) { ?>
  <tr id="table-<?= $row->register_petugas; ?>">
    <td><?= $no++; ?></td>
    <td><?= $row->register_petugas; ?></td>
    <td><?= $row->nipk_petugas; ?></td>
    <td><?= $row->nama_petugas; ?></td>
    <td><?= $row->tempat_petugas.'/'.setdate($row->tanggal_petugas); ?></td>
    <td><?= gender($row->kelamin_petugas); ?></td>
    <td><?= $row->telepon_petugas; ?></td>
    <td><?= $row->alamat_petugas; ?></td>
    <td>
      <a onclick="changeurl('guru.php?page=edit&id=<?= encode($row->register_petugas); ?>');" id="edit<?= $row->register_petugas; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"> Edit</a>
      <a onclick="deleteRecord('resource/views/guru/inc/_delete.php', '<?= $row->register_petugas; ?>');" class="btn btn-sm btn-warning"><span class="fa fa-trash-alt"> Delete</a>
    </td>
  </tr>
  <script type="text/javascript">
    $('#edit<?= $row->register_petugas; ?>').click( function() {
      $('#tampil').load('resource/views/guru/_edit.php', {id: '<?= encode($row->register_petugas); ?>'});
    });
  </script>
  <?php }}} ?>
