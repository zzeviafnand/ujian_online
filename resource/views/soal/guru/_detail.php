<a onclick="changeurl('soal.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
<a id="print" class="btn btn-sm btn-dark float-right"><i class="fa fa-print"></i> Print</a>
<a onclick="changeurl('soal.php?soal=show&tambah&id=<?= $_GET['id']; ?>');" id="tambahSoal" class="btn btn-sm btn-dark float-right mr-2"><i class="fa fa-plus"></i> Add Soal</a>
<p></p>
<div class="table-responsive">
  <table class="table table-sm table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Kategori</th>
        <th class="col-th-3">Pertanyaan</th>
        <th>Skor</th>
        <th id="table-th-3">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
        require_once __DIR__.'/../../../../app/config.php';
        $a = 1;
        $s = $_SESSION['role_petugas'];
        if ($s == 1) {
          $posts = $db->table('soal')->where('id_kbm', $_GET['id'])->get();
        }elseif ($s == 3) {
          $posts = $db->table('soal')->join('kbm', 'kbm.id_kbm', '=', 'soal.id_kbm')->where('soal.id_kbm = ? AND kbm.register_petugas = ?', [$_GET['id'], $_SESSION['user_petugas']])->get();
        }
        if (is_array($posts)):
          foreach ($posts as $key => $row) :
            if ($row->kategori_soal == 1) {
              $db->table('soaljawab')->where('id_soal', $row->id_soal)->get();
              $col =  $db->num_rows();
            }
      ?>
      <main id="table-<?= $row->id_soal; ?>">
        <tr>
          <!-- nomor -->
          <td rowspan="<?= $col+1; ?>"><?= $a++; ?></td>
          <!-- end nomor -->
          <!-- kategori -->
          <td rowspan="<?= $col+1; ?>"><?= ($row->kategori_soal == 1) ? 'Objektif' : 'Essay'; ?></td>
          <!-- end kategori -->
          <!-- soal -->
          <td>
            <article class="text-justify soal-article">
              <?= $row->text_soal; ?>
            </article>
          </td>
          <!-- end soal -->
          <!-- skor -->
          <td rowspan="<?= $col+1; ?>"><?= $row->skor_soal; ?></td>
          <!-- end skor -->
          <!-- aksi -->
          <td rowspan="<?= $col+1; ?>">
            <a onclick="changeurl('soal.php?soal=show&edit=<?= $row->id_kbm; ?>&id=<?= $row->id_soal; ?>');" id="edit<?= $row->id_soal; ?>" class="btn btn-sm btn-info"><span class="fa fa-edit"> Edit</a>
              <script type="text/javascript">
              $('#edit<?= $row->id_soal; ?>').click( function() {
                $('#tampil').load('resource/views/soal/guru/_edit.php?edit=<?= $row->id_kbm; ?>&id=<?= $row->id_soal; ?>');
              });
              </script>
            <a onclick="deleteRecord('resource/views/soal/guru/inc/_delete.php', <?= $row->id_soal; ?>);" class="btn btn-sm btn-warning"><span class="fa fa-trash-alt"> Delete</a>
          </td>
          <!-- end aksi -->
        </tr>
        <!-- soaljawab -->
        <?php if ($row->kategori_soal == 1): ?>
          <?php
          $j = 1;
          $array = [1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E'];
          $post = $db->table('soaljawab')->where('id_soal', $row->id_soal)->get();
          if (is_array($post)) {
          foreach ($post as $key => $val): ?>
            <tr id="tampilsoaljawab">
              <?php if ($val->kunci_soaljawab == 1): ?>
                <td class="col-th-4 text-soaljawab"><?= $array[$j].') '. $val->text_soaljawab; $j++; ?></td>
              <?php else: ?>
                <td class="col-th-4"><?= $array[$j].') '. $val->text_soaljawab; $j++; ?></td>
              <?php endif; ?>
            </tr>
          <?php endforeach; }?>
        <?php endif; ?>
        <!-- end soaljawab -->
      </main>
    <?php endforeach; endif; // end data soal ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready( function() {
<?php
  if ($s == 1) {?>
    $('#home').click( function() {
      $('#tampil').load('resource/views/soal/guru/_show.php');
    });
<?php }elseif ($s == 3) {?>
    $('#home').click( function() {
      $('#tampil').load('resource/views/soal/guru/_show.php');
    });
<?php } ?>
    $('#print').click( function() {
      window.print();
    });
    $('#tambahSoal').click( function() {
      $('#tampil').load('resource/views/soal/guru/_add.php?id=<?= $_GET['id']; ?>');
    });
  });
</script>
