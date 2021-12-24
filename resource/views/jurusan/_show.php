<?php if (isset($_POST['page'])): ?>
  <a onclick="changeurl('jurusan.php?page=tambah');" id="tambah" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Jurusan</a>
  <p></p>
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th class="col-th-3">Kode Jurusan</th>
          <th class="col-th-4">Jurusan</th>
          <th class="col-th-3">Kajur</th>
          <th id="table-th-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require_once __DIR__.'/../../../app/config.php';
        $no = 1;
        $posts = $db->table('jurusan')->pagination(10, 1)->join('petugas', 'petugas.register_petugas', '=', 'jurusan.register_petugas')->orderBy('nama_jurusan', 'ASC')->get();
        if (is_array($posts)) {
          foreach ($posts as $key => $row) {?>
        <tr id="table-<?= $row->kode_jurusan; ?>">
          <td><?= $no++; ?></td>
          <td><?= $row->kode_jurusan; ?></td>
          <td><?= $row->nama_jurusan; ?></td>
          <td><?= $row->nama_petugas; ?></td>
          <td>
            <a onclick="changeurl('jurusan.php?page=edit&id=<?= encode($row->kode_jurusan); ?>');" id="edit<?= $row->kode_jurusan; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"> Edit</a>
              <a onclick="deleteRecord('resource/views/jurusan/inc/_delete.php', '<?= $row->kode_jurusan; ?>');" class="btn btn-sm btn-warning"><span class="fa fa-trash-alt"> Delete</a>
              </td>
            </tr>
            <script type="text/javascript">
            $('#edit<?= $row->kode_jurusan; ?>').click( function() {
              $('#tampil').load('resource/views/jurusan/_edit.php', {id: '<?= encode($row->kode_jurusan); ?>'});
            });
            </script>
          <?php }} ?>
        </tbody>
      </table>
    </div>
    <script type="text/javascript">
    $(document).ready( function() {
      $('#tambah').click( function() {
        $('#tampil').load('resource/views/jurusan/_add.php', {page: '<?= token(32); ?>'});
      });
    });
  </script>
<?php endif; ?>
