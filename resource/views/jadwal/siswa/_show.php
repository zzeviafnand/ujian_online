<div class="row">
  <?php
    require_once __DIR__.'/../../../../app/config.php';
    $no = 1;

    // Untuk mengambil pengaturan Siswa
    foreach ($db->table('siswa')->select('pengaturan_siswa')->where('nis_siswa', $_SESSION['role_siswa'])->get() as $key => $setting);
    $setSiswa = ($setting->pengaturan_siswa == '') ? [3 => 0, 4 => 0] : explode(':', $setting->pengaturan_siswa);

    $fields = [
      'kelas' => 'kelas.kode_kelas = jadwal.kode_kelas',
      'siswa' => 'siswa.kode_kelas = kelas.kode_kelas',
      'kbm' => 'kbm.id_kbm = jadwal.id_kbm',
      'mapel' => 'mapel.id_mapel = kbm.id_mapel',
    ];
    $posts = $db->table('jadwal')->where('username = ? AND status_jadwal = ?', [$_SESSION['role_siswa'], 1])->selfJoin($fields)->get();
    if (is_array($posts)) {
      foreach ($posts as $key => $row) {
        $startDate = strtotime($row->tanggal_mulai_jadwal);
        $endDate = strtotime($row->tanggal_selesai_jadwal);
        $todayDate = strtotime(date('Y-m-d H:m:s'));
        if ($todayDate >= $startDate && $todayDate <= $endDate) {

        $soal = $db->table('soal')->where('id_kbm', $row->id_kbm)->get();
        // Untuk mengambil pengaturan Jadwal
        $setJadwal = explode(':', $row->pengaturan_jadwal);
        $jadwal = (isset($_COOKIE['jadwal'])) ? decode($_COOKIE['jadwal']) : 0;
  ?>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title"><?= $row->nama_jadwal; ?></h5>
        <p class="card-text"><?= $row->keterangan_jadwal; ?></p>
      </div>
      <div class="card-body">
        <table class="table">
          <tr>
            <th>Waktu mulai</th>
            <td><?= setDateTime($row->tanggal_mulai_jadwal); ?></td>
          </tr>
          <tr>
            <th>Waktu selesai</th>
            <td><?= setDateTime($row->tanggal_selesai_jadwal); ?></td>
          </tr>
          <tr>
            <th>Waktu ujian</th>
            <td><?= $row->waktu_jadwal; ?> Menit</td>
          </tr>
          <tr>
            <th>Tipe soal</th>
            <td>
              <?php
              if (is_array($soal)) {
                $type1 = '';
                $type2 = '';
                foreach ($soal as $key => $tipe) {
                  if ($tipe->kategori_soal == 1) {
                    $type1 = 'Objektif';
                  } else {
                    $type2 = 'Essay';
                  }
                }
                echo ($type1 == '') ? $type2 : ($type2 == '') ? $type1 : $type1.' & '.$type2;
              }
              ?>
            </td>
          </tr>
          <tr>
            <th>Jumlah</th>
            <td><?= $db->num_rows();; ?> Soal</td>
          </tr>
          <tr>
            <th>Nilai dasar</th>
            <td>
              <?php
              if (is_array($soal)) {
                foreach ($soal as $key => $poin);
                echo $poin->skor_soal;
              }
              ?>
            </td>
          </tr>
          <tr>
            <th>Skor minimal</th>
            <td><?= $row->kkm_mapel; ?></td>
          </tr>
          <tr>
            <th>Skor maksimal</th>
            <td>
              <?php
              if (is_array($soal)) {
                $total = 0;
                foreach ($soal as $key => $skor) {
                  $total = $total + $skor->skor_soal;
                }
                echo $total;
              }
               ?>
            </td>
          </tr>
          <tr>
            <th>Nilai tercapai</th>
            <td>
            <?php
              $hasil = $db->table('jawab')->join('soal', 'soal.id_soal', '=', 'jawab.id_soal')->where('id_jadwal = ? AND nis_siswa = ?', [$row->id_jadwal, $_SESSION['role_siswa']])->get();
              $hasiltotal = 0;
              if ($setJadwal[0] == 1) {
                if (is_array($hasil) && !isset($_COOKIE['jadwal']) && !isset($_COOKIE['waktu'])) {
                  foreach ($hasil as $key => $value) {
                    if ($value->hasil_jawab == 1) {
                      $hasiltotal = $hasiltotal + $value->skor_soal;
                    }
                  }
                  echo $hasiltotal;
                } else {
                  echo "Ya";
                }
              } else {
                echo "Tidak";
              }
             ?>
            </td>
          </tr>
          <tr>
            <th>Laporan hasil</th>
            <td>
            <?php
              if ($setJadwal[1] == 1) {
                if (is_array($hasil) && !isset($_COOKIE['jadwal']) && !isset($_COOKIE['waktu'])) {
                  if ($hasiltotal >= $row->kkm_mapel) {
                    echo "<b>Lulus</b>";
                  } else {
                    echo "<mark>Tidak Lulus</mark>";
                  }
                } else {
                  echo "Ya";
                }
              } else {
                echo "Tidak";
              }
            ?>
            </td>
          </tr>
          <tr>
            <th>Dapat diulang</th>
            <td>
            <?php if ($setJadwal[2] == 1): ?>
              Ya
            <?php else: ?>
              Tidak
            <?php endif; ?>
            </td>
          </tr>
        </table>
        <div id="jadwalUjian">
          <?php
            $post = $db->table('jawab')->where('nis_siswa = ? AND id_jadwal = ?', [$_SESSION['role_siswa'], $row->id_jadwal])->get();
            if (is_array($post)) {
              foreach ($post as $key => $jawab);
              if (($setSiswa[3] == $jawab->id_jadwal && $jadwal == $jawab->id_jadwal && isset($_COOKIE['waktu'])) || ($setSiswa[4] == 1 && $setSiswa[3] == $jawab->id_jadwal)) {
                ?>
                <button type="button" class="btn btn-sm btn-block btn-info" name="<?= encode($row->id_kbm); ?>" value="<?= encode($row->id_jadwal); ?>">
                  <span class="fa fa-pen-square"><span> Lanjutkan
                </button>
                <?php
              } elseif ($row->id_jadwal != $jadwal && $row->id_jadwal != $jawab->id_jadwal) {
                echo "<h4 class='text-center'>Tunggu Selesai</h4>";
              } elseif ($setJadwal[2] == 1) {?>
                <button type="button" class="btn btn-sm btn-block btn-primary" name="<?= encode($row->id_kbm); ?>" value="<?= encode($row->id_jadwal); ?>">
                  <span class="fa fa-pen-square"><span> Ulangi Ujian
                </button>
                <?php
              } else {
                echo "<h4 class='text-center'>Selesai</h4>";
              }
            } else {
              if (isset($_COOKIE['jadwal']) && isset($_COOKIE['waktu']) && $setSiswa[5] == 0 || $setSiswa['4'] == 1) {
                echo "<h4 class='text-center'>Menunggu</h4>";
              } else {
                ?>
                <button type="button" class="btn btn-sm btn-block btn-success" name="<?= encode($row->id_kbm); ?>" value="<?= encode($row->id_jadwal); ?>">
                  <span class="fa fa-pen-square"><span> Kerjakan
                </button>
                <?php
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>
<?php } // end start and end jadwal
}}else {
  echo "<h3 class='text-center'>Jadwal Belum Aktif</h3>";
} ?>
</div>
<script type="text/javascript">
  $('#jadwalUjian button').click( function() {
    if (confirm('Mulai menyakinkan ujian berlangsung')) {
      $.ajax({
        type: 'POST',
        url: 'resource/views/jadwal/siswa/_ujian.php',
        data: {
          kbm: $(this).attr('name'),
          jadwal: $(this).attr('value')
        },
        cache: false,
        success: function(data) {
          $('#tampiljadwal').html(data);
        }
      });
    }
  });
</script>
