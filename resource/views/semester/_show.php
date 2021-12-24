<?php if (isset($_POST['page'])): ?>
<a onclick="changeurl('semester.php?page=tambah');" id="tambah" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Semester</a>
<p></p>
<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th class="col-th-3">Kode Semester</th>
        <th class="col-th-3">Tahun Ajaran</th>
        <th class="col-th-2">Semester</th>
        <th class="col-th-2">Keterangan</th>
        <th id="table-th-3">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once __DIR__.'/../../../app/config.php';
      $no = 1;
      $posts = $db->table('semester')->pagination(10, 1)->join('tahunajaran', 'tahunajaran.kode_tahunajaran', '=', 'semester.kode_tahunajaran')->orderBy('kode_semester', 'DESC')->get();
      if (is_array($posts)) {
        foreach ($posts as $key => $row) { ?>
    <tr id="table-<?= $row->kode_semester; ?>">
      <td><?= $no++; ?></td>
      <td><?= $row->kode_semester; ?></td>
      <td><?= $row->nama_tahunajaran; ?></td>
      <td><?= $row->kategori_semester; ?></td>
      <td><?= kateSemes($row->kategori_semester); ?></td>
      <td>
        <a onclick="changeurl('semester.php?page=edit&id=<?= encode($row->kode_semester); ?>');" id="edit<?= $row->kode_semester; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"> Edit</a>
          <a onclick="deleteRecord('resource/views/semester/inc/_delete.php', '<?= $row->kode_semester; ?>');" class="btn btn-sm btn-warning"><span class="fa fa-trash-alt"> Delete</a>
          </td>
        </tr>
        <script type="text/javascript">
        $('#edit<?= $row->kode_semester; ?>').click( function() {
          $('#tampil').load('resource/views/semester/_edit.php', {id: '<?= encode($row->kode_semester); ?>'});
        });
        </script>
      <?php }} ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready( function() {
    $('#tambah').click( function() {
      $('#tampil').load('resource/views/semester/_add.php', {page: '<?= token(32); ?>'});
    });
  });
</script>
<?php endif; ?>
