<?php if (isset($_POST['page'])): ?>
<a onclick="changeurl('tahunajaran.php?page=tambah');" id="tambah" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Tahun Ajaran</a>
<p></p>
<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th class="col-th-3">Kode Ajaran</th>
        <th class="col-th-3">Tahun Ajaran</th>
        <th id="table-th-3">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once __DIR__.'/../../../app/config.php';
      $no = 1;
      $posts = $db->table('tahunajaran')->pagination(10, 1)->orderBy('kode_tahunajaran', 'DESC')->get();
      if (is_array($posts)) {
        foreach ($posts as $key => $row) { ?>
    <tr id="table-<?= $row->kode_tahunajaran; ?>">
      <td><?= $no++; ?></td>
      <td><?= $row->kode_tahunajaran; ?></td>
      <td><?= $row->nama_tahunajaran; ?></td>
      <td>
        <a onclick="changeurl('tahunajaran.php?page=edit&id=<?= encode($row->kode_tahunajaran); ?>');" id="edit<?= $row->kode_tahunajaran; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"> Edit</a>
          <a onclick="deleteRecord('resource/views/tahunajaran/inc/_delete.php', '<?= $row->kode_tahunajaran; ?>');" class="btn btn-sm btn-warning"><span class="fa fa-trash-alt"> Delete</a>
          </td>
        </tr>
        <script type="text/javascript">
        $('#edit<?= $row->kode_tahunajaran; ?>').click( function() {
          requestUrl("resource/views/tahunajaran/_edit.php", "<?= encode($row->kode_tahunajaran); ?>");
        });
        </script>
      <?php }} ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready( function() {
    $('#tambah').click( function() {
      requestUrl("resource/views/tahunajaran/_add.php");
    });
  });
</script>

<?php endif; ?>
