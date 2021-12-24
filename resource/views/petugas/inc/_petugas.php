<?php
if (isset($_POST['rows'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $no = 1;

  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;
  $search = (isset($_POST['search'])) ? $_POST['search'] : '';
  $posts = $db->table('petugas')->pagination($lenght, 1)->like('petugas.nama_petugas', "%".$search."%")->orderBy('register_petugas')->get();

  if (is_array($posts)) {
    foreach ($posts as $key => $row) {
?>
<tr id="table-<?= $row->register_petugas; ?>">
  <td><?= $no++; ?></td>
  <td><?= $row->register_petugas; ?></td>
  <td><?= $row->nipk_petugas; ?></td>
  <td><?= $row->nama_petugas; ?></td>
  <td><?= $row->tempat_petugas.'/'.setdate($row->tanggal_petugas); ?></td>
  <td><?= gender($row->kelamin_petugas); ?></td>
  <td><?= level($row->level_petugas); ?></td>
  <td><?= $row->telepon_petugas; ?></td>
  <td><?= $row->alamat_petugas; ?></td>
  <td>
    <a onclick="changeurl('petugas.php?page=edit&id=<?= encode($row->register_petugas); ?>');" id="edit<?= $row->register_petugas; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"> Edit</a>
    <?php if ($row->register_petugas != $_SESSION['user_petugas']): ?>
      <a onclick="deleteRecord('resource/views/petugas/inc/_delete.php', '<?= $row->register_petugas; ?>');" class="btn btn-sm btn-warning" onclick="return confirm('Anda yakin ingin menghapus data tersebut?');"><span class="fa fa-trash-alt"> Delete</a>
    <?php endif; ?>
  </td>
</tr>
<script type="text/javascript">
  $('#edit<?= $row->register_petugas; ?>').click( function() {
    $('#tampil').load('resource/views/petugas/_edit.php', {id: "<?= encode($row->register_petugas); ?>"});
  });
</script>
<?php }}} ?>
