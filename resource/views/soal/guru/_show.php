<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th class="col-th-4">Mapel</th>
        <th class="col-th-3">Jumlah Soal</th>
        <th id="table-th-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
        require_once __DIR__.'/../../../../app/config.php';
        $no = 1;
        $fields = [
          'mapel' => 'mapel.id_mapel = kbm.id_mapel',
          // 'kelas' => 'kelas.id_kelas = kbm.id_kelas',
        ];
        $posts = $db->table('kbm')->where('kbm.register_petugas', $_SESSION['user_petugas'])->orderBy('nama_mapel')->selfJoin($fields)->get();
        if (is_array($posts)) :
          foreach ($posts as $key => $row) :
      ?>
      <tr id="table-<?= $row->id_kbm; ?>">
        <td><?= $no++; ?></td>
        <td><?= $row->nama_mapel; ?></td>
        <td><?php
             $db->table('soal')->where(['id_kbm' => $row->id_kbm])->get();
             if ($db->num_rows() == 0) {
               echo "Tidak ada ";
             } else {
               echo $db->num_rows();
             }

          ?> Soal</td>
        <td>
          <a onclick="changeurl('soal.php?soal=show&id=<?= $row->id_kbm; ?>');" id="show<?= $row->id_kbm; ?>" class="btn btn-sm btn-info"><span class="fa fa-search-plus"> Show</a>
            <script type="text/javascript">
            $('#show<?= $row->id_kbm; ?>').click( function() {
              $('#tampil').load('resource/views/soal/guru/_detail.php?id=<?= $row->id_kbm; ?>');
            });
            </script>
        </td>
      </tr>
    <?php endforeach; endif; ?>
    </tbody>
  </table>
</div>
