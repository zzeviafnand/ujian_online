<?php
if (isset($_POST['kelas'])) {
  require_once __DIR__.'/../../../../../app/config.php';
  $fields = [
    'kelas' => 'kelas.kode_kelas = siswa.kode_kelas',
  ];

  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;
  $search = (isset($_POST['search'])) ? "%".$_POST['search']."%" : '';
  if ($_POST['kelas'] == 'all') {
    $posts = $db->table('siswa')->pagination($lenght, 1)->selfJoin($fields)->like('siswa.nama_siswa', "%".$search."%")->orderBy('nis_siswa')->get();
  } else {
    $posts = $db->table('siswa')->pagination($lenght, 1)->selfJoin($fields)->where('kelas.kode_kelas', $_POST['kelas'])->like('siswa.nama_siswa', $search)->orderBy('nis_siswa')->get();
  }
  if (is_array($posts)) {
    foreach ($posts as $key => $row) {
      $settings = (is_null($row->pengaturan_siswa)) ? [4 => null, 5 => null] : explode(':', $row->pengaturan_siswa);

?>
<tr id="table-<?= $row->nis_siswa; ?>">
  <td><?= $row->nis_siswa; ?></td>
  <td><?= $row->nama_siswa; ?></td>
  <td><?= $row->nama_kelas; ?></td>
  <td><?= $row->username; ?></td>
  <td>
    <div class="settings">
        <?php if (is_null($settings[4])): ?>
          Menunggu ujian
        <?php else:
          $status = $settings[4];
           if ($status == 1): ?>
           <button type="button" value="0" id="<?= $row->nis_siswa; ?>" name="4" class="btn btn-sm btn-primary">
             <span class="fa fa-toggle-on"></span> Nonaktif
           </button>
          <?php else: ?>
            <button type="button" value="1" id="<?= $row->nis_siswa; ?>" name="4" class="btn btn-sm btn-danger">
              <span class="fa fa-toggle-off"></span> Aktif
            </button>
          <?php endif; ?>
        <?php endif; ?>
    </div>
  </td>
  <td>
    <div class="settings">
      <?php if (is_null($settings[5])): ?>
        Menunggu ujian
      <?php else:
        $reload = $settings[5];
        if ($reload == 1): ?>
        <button type="button" value="0" id="<?= $row->nis_siswa; ?>" name="5" class="btn btn-sm btn-primary">
          <span class="fa fa-toggle-on"></span> Nonaktif
        </button>
      <?php else: ?>
        <button type="button" value="1" id="<?= $row->nis_siswa; ?>" name="5" class="btn btn-sm btn-danger">
          <span class="fa fa-toggle-off"></span> Aktif
        </button>
      <?php endif; ?>
    <?php endif; ?>
    </div>
  </td>
  <td>
    <div id="edit">
      <button type="button" id="<?= encode($row->nis_siswa); ?>" class="btn btn-sm btn-info" onclick="changeurl('siswa.php?page=edit&id=<?= encode($row->nis_siswa); ?>');">
        <span class="fa fa-edit"></span> Edit
      </button>
    </div>
  </td>
</tr>
<?php }
} ?>
<script type="text/javascript">
  $(document).ready( function() {
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
      $(this).load('resource/views/siswa/proktor/inc/_settings.php', {nis: $(this).attr('id'), column: $(this).attr('name'), status: status});
    });
    $('#edit button').click( function() {
      $('#tampil').load('resource/views/siswa/proktor/_edit.php', {id: $(this).attr('id')});
    });
  });
</script>
<?php } ?>
