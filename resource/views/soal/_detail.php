<a onclick="changeurl('soal.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
<p></p>
<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Kategori</th>
        <th class="col-th-3">Pertanyaan</th>
      </tr>
    </thead>
    <tbody>
      <?php
        require_once __DIR__.'/../../../app/config.php';
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
      <div id="tampilDetail<?= $row->id_soal; ?>">
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
              <td class="col-th-4"><?= $array[$j].') '. $val->text_soaljawab; $j++; ?></td>
            </tr>
          <?php endforeach; } ?>
        <?php endif; ?>
        <!-- end soaljawab -->
      </div>
    <?php endforeach; endif; // end data soal ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready( function() {
<?php
  if ($s == 1) {?>
    $('#home').click( function() {
      $('#tampil').load('resource/views/soal/_show.php');
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
      $('#tampil').load('resource/views/soal/_addSoal.php?id=<?= $_GET['id']; ?>');
    });
  });
</script>
