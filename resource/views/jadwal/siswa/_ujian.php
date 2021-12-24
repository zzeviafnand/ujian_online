<?php
if (isset($_POST['kbm']) && isset($_POST['jadwal'])) {
  require_once __DIR__.'/../../../../app/config.php';
  $kbm = decode($_POST['kbm']);
  $siswa = $_SESSION['role_siswa'];
  $jadwal = decode($_POST['jadwal']);
  $jadwalCookie = (isset($_COOKIE['jadwal'])) ? decode($_COOKIE['jadwal']) : 0;

  // mengambil waktu dan settings ulang laporan
  foreach ($db->table('jadwal')->select('waktu_jadwal, pengaturan_jadwal')->where('id_jadwal', $jadwal)->get() as $key => $rowJadwal);
  $setJadwal = explode(':', $rowJadwal->pengaturan_jadwal);

  // Sisa waktu atau waktu baru ujian
  // pengaturan siswa merupakan hal penting (harus pengetahun lebih ke developer)
  foreach ($db->table('siswa')->select('pengaturan_siswa')->where('nis_siswa', $siswa)->get() as $key => $rowSiswa);
  $setSiswa = explode(':', $rowSiswa->pengaturan_siswa);
  $status = (isset($setSiswa[4])) ? $setSiswa[4] : 0;
  $reload = (isset($setSiswa[5])) ? $setSiswa[5] : 0;
  // var_dump($setSiswa);

  // Membuat soal acak
  if ($db->table('jawab')->where('id_jadwal = ? AND nis_siswa = ?', [$jadwal, $siswa])->get() == 0) {
    // echo "Baru";
    foreach ($db->table('soal')->orderBy('rand()')->where('id_kbm', $kbm)->get() as $key => $row) {
      $db->table('jawab')->insert(['nis_siswa' => $siswa, 'id_jadwal' => $jadwal, 'id_soal' => $row->id_soal]);
    }
  }else {
    // echo "Utama";
    // Menonaktifkan status(Pindah) automatis
    if ($status == 1) {
      // echo "string4";
      $fields = ['pengaturan_siswa' => $setSiswa[0].':'.$setSiswa[1].':'.$setSiswa[2].':'.$setSiswa[3].':0'.':'.$setSiswa[5]];
      $db->table('siswa')->where('nis_siswa', $siswa)->update($fields);
    }else {
      // Mengulang Ujian
      if ($reload == 0 && $setJadwal[2] == 1 && !isset($_COOKIE['jadwal'])) {
        // echo "string1";
        foreach ($db->table('jawab')->where('id_jadwal = ? AND nis_siswa = ?', [$jadwal, $siswa])->get() as $key => $value) {
          if (!is_null($value->id_soaljawab)) {
            $db->table('jawab')->where('id', $value->id)->update(['id_soaljawab' => null, 'hasil_jawab' => 0]);
          }
        }
      }
      if ($reload == 1 && $jadwal != $jadwalCookie) {
        // echo "string2";
        // delete jawab apabila salah menekan urutan jadwal ujian
        // Ingat!!! harus dipersetujui dan hal bisa membahayakan data jawab Mengulang
        $db->table('jawab')->where('id_jadwal = ? AND nis_siswa = ?', [$jadwal, $siswa])->delete();
        foreach ($db->table('soal')->orderBy('rand()')->where('id_kbm', $kbm)->get() as $key => $row) {
          $db->table('jawab')->insert(['nis_siswa' => $siswa, 'id_jadwal' => $jadwal, 'id_soal' => $row->id_soal]);
        }
      }
    } // penutup nonaktifkan status Siswa

    if ($reload == 1) {
      // echo "string3";
      $fields = ['pengaturan_siswa' => $setSiswa[0].':'.$setSiswa[1].':'.$setSiswa[2].':'.$setSiswa[3].':'.$setSiswa[4].':0'];
      $db->table('siswa')->where('nis_siswa', $siswa)->update($fields);
    }

  } // Paling utama

  // Apabila cookie habis maka akan mengambil sisaWaktu pada Siswa
  // hal ini harus di setujui oleh proktor
  // hal ini bisa juga untuk memindahkan murid ke komputer lain
  if ($rowSiswa->pengaturan_siswa == null || $reload == 1 && $jadwal != $setSiswa[3]) {
    $waktu = $rowJadwal->waktu_jadwal*60;
    setCookie('waktu', encode($waktu), time()+$waktu, '/');
    setCookie('jadwal', encode($jadwal), time()+$waktu, '/');
    // jam:menit:detik:jadwal:status:reload is array settings
    $db->table('siswa')->where('nis_siswa', $siswa)->update(['pengaturan_siswa' => floor($waktu/3600).':'.floor(($waktu%3600)/60).':'.floor((($waktu%3600)%60)/1).':'.$jadwal.':0'.':0']);
  }else {
    // akan dijalankan apa bila cookie masih tersedia
    // variable $waktu akan di gunakan dalam javascript
    // jangan di perbarui kodingan dibawah ini sebelum pengetahun developer
    if (empty($_COOKIE['waktu'])) {
      $waktu = ($setSiswa[0]*60*60) + ($setSiswa[1]*60) + $setSiswa[2];
      setCookie('waktu', encode($waktu), time()+$waktu, '/');
      setCookie('jadwal', encode($setSiswa[3]), time()+$waktu, '/');
    } else {
      $waktu = decode($_COOKIE['waktu']);
    }
  }

  // untuk waktu hitung mundur
  $jam = 'a'.token(8);
  $menit = 'a'.token(8);
  $detik = 'a'.token(8);
?>
<div class="row">
  <div class="col-lg-9">
    <div class="card text">
      <div class="card-header">
        <h4 class="float-right">Sisa: <span id="waktu"></span></h4>
        <script type="text/javascript">
          var <?= $detik; ?> = <?= floor((($waktu%3600)%60)/1); ?>;
          var <?= $menit; ?> = <?= floor(($waktu%3600)/60); ?>;
          var <?= $jam; ?> = <?= floor($waktu/3600); ?>;
          function hitung() {
            // setTimeout(hitung, 1000);
            $('#waktu').html(<?= $jam; ?>+':'+<?= $menit; ?>+':'+<?= $detik; ?>);
            $('#sisaWaktu').html(<?= $jam; ?>+':'+<?= $menit; ?>+':'+<?= $detik; ?>);
            <?= $detik; ?>--;
            if (<?= $menit; ?> < 15 && <?= $jam; ?> == 0) {
              $('#waktu').css("color", "#ffc107");
            }
            if (<?= $menit; ?> < 5 && <?= $jam; ?> == 0) {
              $('#waktu').css("color", "red");
            }
            if (<?= $detik; ?> < 0) {
              <?= $detik; ?> = 59;
              <?= $menit; ?>--;
              if (<?= $menit; ?> < 0) {
                <?= $detik; ?> = 59;
                <?= $menit; ?> = 59;
                <?= $jam; ?>--;
                if (<?= $jam; ?> < 0) {
                  <?= $detik; ?> = 0;
                  <?= $menit; ?> = 0;
                  <?= $jam; ?> = 0;
                  $('#breadcrumb').show();
                  $('#tampiljadwal').load('resource/views/jadwal/siswa/inc/_selesai.php', {selesai: '<?= encode($siswa); ?>'});
                  return changeurl('jadwal.php');
                }
              }
            }
          }

          hitung();
        </script>
        <h4>Soal No <span id="tampilnomor">1</span></h4>
      </div>
      <div id="tampilsoal">

      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card">
      <div class="card-header">
        <h4>Daftar Soal</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <?php
          $noSoal = 1;
          foreach ($posts = $db->table('jawab')->where('nis_siswa = ? AND id_jadwal = ?', [$siswa, $jadwal])->get() as $key => $soal) {?>
            <div class="col-soal-2" id="daftarsoal">
              <?php if ($soal->hasil_jawab == 0): ?>
                <button type="button" id="nomorSoal<?= $noSoal; ?>" class="btn btn-block btn-warning" value="<?= $noSoal; ?>">
                  <?= $noSoal++; ?>
                </button>
              <?php else: ?>
                <button type="button" id="nomorSoal<?= $noSoal; ?>" class="btn btn-block btn-primary" value="<?= $noSoal; ?>">
                  <?= $noSoal++; ?>
                </button>
              <?php endif; ?>
            </div>
          <?php }?>
        </div>
      </div>
      <div class="card-footer" id="selesei">
        <form>
          <button type="submit" class="btn btn-success btn-block">Selesai</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready( function() {
  $('#breadcrumb').hide();
  // Disable
  $('.ujianlangsung').css('visibility', 'hidden');
  $('.page').css('min-width', '100%');
  $('.page.active').css('min-width', '100%');
  $('nav.navbar').css('padding', '0');
  $('.navbar').css('padding', '0');
  $('#tampilwaktu').load('resource/views/jadwal/siswa/inc/_waktu.php');
  $('#tampilsoal').load('resource/views/jadwal/siswa/inc/_soal.php', {
    siswa: '<?= encode($siswa); ?>',
    jadwal:'<?= encode($jadwal); ?>'
  });

  // Daftar Soal
  $('#daftarsoal button').click( function() {
    changeurl('jadwal.php?jadwal=<?= encode($jadwal); ?>&soal='+$(this).attr('value'));
    var page = $(this).attr('value');
    $('#tampilnomor').text(page);
    $.ajax({
      type: 'POST',
      url: 'resource/views/jadwal/siswa/inc/_soal.php',
      data: {
        siswa: '<?= encode($siswa); ?>',
        jadwal: '<?= encode($jadwal); ?>',
        page: page
      },
      cache: false,
      success: function(data){
        $("#tampilsoal").html(data);
      }
    });
  });
  $('form').submit( function(e) {
    e.preventDefault();
    if (confirm('Apakah kamu yakin sudah selesai')) {
      $('#breadcrumb').show();
      $('#tampiljadwal').load('resource/views/jadwal/siswa/inc/_selesai.php', {selesai: '<?= encode($siswa); ?>'});
      return changeurl('jadwal.php');
    }
  });

});
// Waktu expired
function expired() {
  $.ajax({
    url: 'resource/views/jadwal/siswa/inc/_expired.php',
    method:"POST",
    data:{
      waktu: $('#sisaWaktu').text()
    },
    dataType: "json",
    success: function(data) {
    }
  });
}
// expired();
setInterval(function() {
  expired();
  hitung();
}, 1000);
</script>
<?php } ?>
