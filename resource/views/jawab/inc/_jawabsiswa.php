<?php
if (isset($_POST['nis'])) {
  require_once __DIR__.'/../../../../app/config.php';

  $no = 1;
  $fields = [
    'soal' => 'soal.id_soal = jawab.id_soal',
    'kbm' => 'kbm.id_kbm = soal.id_kbm',
  ];
  $lenght = (isset($_POST['rows'])) ? $_POST['rows'] : 10;
  $kategori = (isset($_POST['kategori'])) ? $_POST['kategori'] : 'all';
  if ($kategori == 'all') {
    $posts = $db->table('jawab')->pagination($lenght, 1)->selfJoin($fields)->where('nis_siswa = ? AND kbm.register_petugas = ?', [decode($_POST['nis']), $_SESSION['user_petugas']])->get();
  } else {
    $posts = $db->table('jawab')->pagination($lenght, 1)->selfJoin($fields)->where('nis_siswa = ? AND kbm.register_petugas = ? AND soal.kategori_soal = ?', [decode($_POST['nis']), $_SESSION['user_petugas'], $_POST['kategori']])->get();
  }
  if (is_array($posts)) {
    foreach ($posts as $key => $row) { ?>
      <tr>
        <td><?= $no++; ?></td>
        <td>
          <article class="text-justify soal-article">
            <?= $row->text_soal; ?>
          </article>
        </td>
        <td>
          <?php
            $post = $db->table('soaljawab')->where('id_soaljawab', $row->id_soaljawab)->get();
            if (is_array($post)) {
              foreach ($post as $key => $value);
              echo (is_null($value->text_soaljawab)) ? 'menunggu' : $value->text_soaljawab;
            }else {
              echo "menunggu";
            }
           ?>
        </td>
        <td>
          <?php if ($row->kategori_soal == 1): ?>
            <?= hasilJawab($row->hasil_jawab); ?>
          <?php elseif ($row->kategori_soal == 2 && $row->id_soaljawab != null): ?>
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="statusnilai">
                  <?php
                  if ($row->hasil_jawab == 1) {
                    echo '<span class="fa fa-smile"></span> Benar';
                  } elseif ($row->hasil_jawab == 2) {
                    echo '<span class="fa fa-angry"></span> Salah';
                  } elseif ($row->hasil_jawab == 3) {
                    echo '<span class="fa fa-meh"></span> Setengah';
                  } else {
                    echo '<span class="fa fa-chart-line"></span> Beri nilai';
                  }
                  ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="download" id="nilaisiswa">
                  <button type="button" name="<?= encode($row->id); ?>" value="1" class="dropdown-item btn-light">
                    <span class="fa fa-smile"></span> Benar
                  </button>
                  <button type="button" name="<?= encode($row->id); ?>" value="2" class="dropdown-item btn-light">
                    <span class="fa fa-angry"></span> Salah
                  </button>
                  <button type="button" name="<?= encode($row->id); ?>" value="3" class="dropdown-item btn-light">
                    <span class="fa fa-meh"></span> Setengah
                  </button>
                </div>
              </div>
            <?php else: ?>
              menunggu
          <?php endif; ?>
        </td>
      </tr>
    <?php }
  }?>
    <script type="text/javascript">
      $(document).ready( function() {
        $("#nilaisiswa button").click( function() {
          $.ajax({
            type: "POST",
            url: "resource/views/jawab/inc/_hasiljawab.php",
            data: {
              id: $(this).attr('name'),
              nilai: $(this).attr('value')
            },
            cache: false,
            success: function(data) {
              $("#statusnilai").html(data);
            }
          });
        });
      });
    </script>

  <?php
}?>
