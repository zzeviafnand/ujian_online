<?php
if (isset($_POST['mapel'])) {

  require_once __DIR__.'/../../../../app/config.php';
  $no = 1;
  $fields = [
    'mapel' => 'mapel.id_mapel = kbm.id_mapel',
    'petugas' => 'petugas.register_petugas = kbm.register_petugas',
  ];

  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;
  if ($_POST['mapel'] == 'all') {
    $posts = $db->table('kbm')->pagination($lenght, 1)->selfJoin($fields)->orderBy('nama_mapel')->get();
  } else {
    $posts = $db->table('kbm')->pagination($lenght, 1)->selfJoin($fields)->where('mapel.id_mapel', $_POST['mapel'])->orderBy('nama_mapel')->get();
  }

  if (is_array($posts)) :
    foreach ($posts as $key => $row) :
?>
<tr id="table-<?= $row->id_kbm; ?>">
  <td><?= $no++; ?></td>
  <td><?= $row->nama_mapel; ?></td>
  <td><?= $row->nama_petugas; ?></td>
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
      $('#tampil').load('resource/views/soal/_detail.php?id=<?= $row->id_kbm; ?>');
    });
    </script>
  </td>
</tr>
<?php
    endforeach;
  endif;
}?>
