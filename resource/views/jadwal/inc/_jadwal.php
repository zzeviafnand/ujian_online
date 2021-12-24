<?php
if (isset($_POST['mapel']) && isset($_POST['mapel'])):
  require_once __DIR__.'/../../../../app/config.php';
  $no = 1;
  $fields = [
    'kelas' => 'kelas.kode_kelas = jadwal.kode_kelas',
    'kbm' => 'jadwal.id_kbm = kbm.id_kbm',
    'mapel' => 'kbm.id_mapel = mapel.id_mapel',
    'petugas' => 'jadwal.register_petugas = petugas.register_petugas',
  ];
  $kelas = $_POST['kelas'];
  $mapel = $_POST['mapel'];
  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;

  if ($kelas == 'all' && $kelas == 'all') {
    $posts = $db->table('jadwal')->pagination($lenght, 1)->selfJoin($fields)->orderBy('nama_mapel')->get();
  } elseif ($kelas == 'all') {
    $posts = $db->table('jadwal')->pagination($lenght, 1)->selfJoin($fields)->where('mapel.id_mapel', $mapel)->orderBy('nama_mapel')->get();
  }  elseif ($mapel == 'all') {
    $posts = $db->table('jadwal')->pagination($lenght, 1)->selfJoin($fields)->where('kelas.kode_kelas', $kelas)->orderBy('nama_mapel')->get();
  } else {
    $posts = $db->table('jadwal')->pagination($lenght, 1)->selfJoin($fields)->where('kelas.kode_kelas = ? AND mapel.id_mapel = ?', [$kelas, $mapel])->orderBy('nama_mapel')->get();
  }

  if (is_array($posts)) {
    foreach ($posts as $key => $row) {
      $settings = explode(':', $row->pengaturan_jadwal);
?>
<tr id="table-<?= $row->id_jadwal; ?>" class="btnAksi">
  <td><?= $no++; ?></td>
  <td><?= $row->nama_jadwal; ?></td>
  <td><?= $row->keterangan_jadwal; ?></td>
  <td><?= $row->nama_mapel; ?></td>
  <td><?= $row->nama_kelas; ?></td>
  <td><?= setDateTime($row->tanggal_mulai_jadwal); ?></td>
  <td><?= setDateTime($row->tanggal_selesai_jadwal); ?></td>
  <td><?= $row->waktu_jadwal; ?>Menit</td>
  <td>
    <div id="tampilstatus">
      <?php if ($row->status_jadwal == 1): ?>
        <button type="button" id="<?= $row->id_jadwal; ?>" value="0" class="btn btn-sm btn-primary">
          <span class="fa fa-toggle-on"></span> Nonaktif
        </button>
      <?php else: ?>
        <button type="button" id="<?= $row->id_jadwal; ?>" value="1" class="btn btn-sm btn-danger">
          <span class="fa fa-toggle-off"></span> Aktif
        </button>
      <?php endif; ?>
    </div>
  </td>
  <td>
    <div class="settings">
      <?php if ($settings[0] == 1): ?>
        <button type="button" id="<?= $row->id_jadwal; ?>" name="0" value="0" class="btn btn-sm btn-primary">
          <span class="fa fa-toggle-on"></span> Nonaktif
        </button>
      <?php else: ?>
        <button type="button" id="<?= $row->id_jadwal; ?>" name="0" value="1" class="btn btn-sm btn-danger">
          <span class="fa fa-toggle-off"></span> Aktif
        </button>
      <?php endif; ?>
    </div>
  </td>
  <td>
    <div class="settings">
      <?php if ($settings[1] == 1): ?>
        <button type="button" id="<?= $row->id_jadwal; ?>" name="1" value="0" class="btn btn-sm btn-primary">
          <span class="fa fa-toggle-on"></span> Nonaktif
        </button>
      <?php else: ?>
        <button type="button" id="<?= $row->id_jadwal; ?>" name="1" value="1" class="btn btn-sm btn-danger">
          <span class="fa fa-toggle-off"></span> Aktif
        </button>
      <?php endif; ?>
    </td>
  </div>
  <td>
    <div class="settings">
      <?php if ($settings[2] == 1): ?>
        <button type="button" id="<?= $row->id_jadwal; ?>" name="2" value="0" class="btn btn-sm btn-primary">
          <span class="fa fa-toggle-on"></span> Nonaktif
        </button>
      <?php else: ?>
        <button type="button" id="<?= $row->id_jadwal; ?>" name="2" value="1" class="btn btn-sm btn-danger">
          <span class="fa fa-toggle-off"></span> Aktif
        </button>
      <?php endif; ?>
    </div>
  </td>
  <td>
    <button id="edit" type="button" value="<?= encode($row->id_jadwal); ?>" class="btn btn-sm btn-info">
      <span class="fa fa-edit"> Edit
    </button>
    <a onclick="deleteRecord('resource/views/jadwal/inc/_delete.php', <?= $row->id_jadwal; ?>);" class="btn btn-sm btn-warning"><span class="fa fa-trash-alt"> Delete</a>
  </td>
</tr>
<?php }} ?>
<script type="text/javascript">
  $('.btnAksi #edit').click( function() {
    var id = $(this).val();
    $('#tampil').load('resource/views/jadwal/_edit.php', {id: id});
    changeurl('jadwal.php?page=edit&id='+id);
  });
  $('.settings button').click( function() {
    var status = $(this).attr('value');
    if (status == 1) {
      $(this).attr('value', '0');
      $(this).removeClass('btn-danger');
      $(this).addClass('btn-primary');
    } else {
      $(this).attr('value', '1');
      $(this).removeClass('btn-primary');
      $(this).addClass('btn-danger');
    }
    $(this).load('resource/views/jadwal/inc/_settings.php', {id: $(this).attr('id'), column: $(this).attr('name'), status: status});
  });
  $('#tampilstatus button').click( function() {
    var status = $(this).attr('value');
    if (status == 1) {
      $(this).attr('value', '0');
      $(this).removeClass('btn-danger');
      $(this).addClass('btn-primary');
    } else {
      $(this).attr('value', '1');
      $(this).removeClass('btn-primary');
      $(this).addClass('btn-danger');
    }
    $(this).load('resource/views/jadwal/inc/_status.php', {id: $(this).attr('id'), status: status});
  });
</script>
<?php endif; ?>
