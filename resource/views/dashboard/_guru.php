<!-- Counts Section -->
<section class="dashboard-counts section-padding">
  <div class="container-fluid">
    <div class="row text-white">
      <div class="col-sm-3">
        <div class="small-box bg-primary" id="boxsoal">
          <div class="inner">
            <?php
              $db->table('soal')->join('kbm', 'kbm.id_kbm', '=', 'soal.id_kbm')->where('register_petugas', $_SESSION['user_petugas'])->get();
              echo '<h3>'.$db->num_rows().'</h3>';
            ?>
            <p>Soal</p>
          </div>
          <div class="icon">
            <i class="fa fa-drafting-compass"></i>
          </div>
          <a class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="small-box bg-primary">
          <div class="inner">
            <?php
              $fields = [
                'kelas' => 'kelas.kode_kelas = siswa.kode_kelas',
                'jadwal' => 'jadwal.kode_kelas = kelas.kode_kelas',
                'kbm' => 'kbm.id_kbm = jadwal.id_kbm',
              ];
              $db->table('siswa')->selfJoin($fields)->where('kbm.register_petugas', $_SESSION['user_petugas'])->get();
              echo '<h3>'.$db->num_rows().'</h3>';
            ?>
            <p>Siswa</p>
          </div>
          <div class="icon">
            <i class="fa fa-child"></i>
          </div>
          <a class="small-box-footer">
            <i></i>
          </a>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="small-box bg-primary" id="boxjawab">
          <div class="inner">
            <?php
            $field = [
              'kbm' => 'kbm.id_kbm = jadwal.id_kbm',
              'jadwal' => 'jadwal.id_jadwal = jawab.id_jadwal',
            ];
            $db->table('jawab')->selfJoin($field)->where('kbm.register_petugas', $_SESSION['user_petugas'])->get();
              echo '<h3>'.$db->num_rows().'</h3>';
            ?>
            <p>Jawaban Siswa</p>
          </div>
          <div class="icon">
            <i class="fa fa-flask"></i>
          </div>
          <a class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="small-box bg-primary">
          <div class="inner">
            <?php
              $fields = [
                'kbm' => 'kbm.id_kbm = jadwal.id_kbm',
                'jadwal' => 'jadwal.id_jadwal = jawab.id_jadwal',
                'jawab' => 'jawab.id_soal = soal.id_soal'
              ];
              $nilai = 0;
              $post = $db->table('soal')->selfJoin($fields)->where('kbm.register_petugas = ? AND hasil_jawab = ?', [$_SESSION['user_petugas'], 1])->get();
              if (is_array($post)) {
                foreach ($post as $key => $row) {
                  $nilai = $nilai + $row->skor_soal;
                }
              }
              $fields = [
                'kelas' => 'kelas.kode_kelas = siswa.kode_kelas',
                'kbm' => 'kbm.id_kbm = jadwal.id_kbm',
                'jadwal' => 'kelas.kode_kelas = jadwal.kode_kelas',
              ];
              $siswa = 0;
              $post = $db->table('siswa')->selfJoin($fields)->where('kbm.register_petugas', $_SESSION['user_petugas'])->get();
              if (is_array($post)) {
                foreach ($post as $key => $row) {
                  if (is_array($db->table('jawab')->join('jadwal', 'jadwal.id_jadwal', '=', 'jawab.id_jadwal')->where('nis_siswa = ? AND id_kbm = ?', [$row->nis_siswa, $row->id_kbm])->get())) {
                    $siswa = $siswa + 1;
                  }
                }
              }
              $total = ($siswa > 0 && $nilai > 0) ? $nilai/$siswa : 0;
              $lenght =  strlen($total);
              if ($lenght > 5) {
                echo '<h3>'.substr($total, 0, 5).'%</h3>';
              } else {
                echo '<h3>'.$total.'%</h3>';
              }
            ?>
            <p>Rata-Rata Nilai</p>
          </div>
          <div class="icon">
            <i class="fa fa-chart-pie"></i>
          </div>
          <a class="small-box-footer">
            <i></i>
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card bar-chart-example">
          <div class="card-header d-flex align-items-center">
            <h4>Jawaban Siswa</h4>
          </div>
          <div class="card-body">
            <canvas id="barSiswa"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card pie-chart-example">
          <div class="card-header d-flex align-items-center">
            <h4>Kelulusan Siswa</h4>
          </div>
          <div class="card-body">
            <canvas id="pieKelulusan"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="public/js/Chart.min.js" charset="utf-8"></script>
<!-- <script src="public/js/charts-custom.js" charset="utf-8"></script> -->
<?php
  $fields = [
    'kelas' => 'kelas.kode_kelas = siswa.kode_kelas'
  ];
$tahun = $db->table('tahunajaran')->pagination(10, 1)->get();


$siswa = $db->table('siswa')->selfJoin([
  'kelas' => 'kelas.kode_kelas = siswa.kode_kelas',
  'jadwal' => 'jadwal.kode_kelas = kelas.kode_kelas',
  'kbm' => 'kbm.id_kbm = jadwal.id_kbm',
  'mapel' => 'mapel.id_mapel = kbm.id_mapel'
])->where('kbm.register_petugas', $_SESSION['user_petugas'])->get();

$gagal = 0;
$tidaklulus = 0;
$lulus = 0;
$belum = 0;
foreach ($siswa as $key => $row) {
  $nilai = 0;
  $jawab = $db->table('jawab')->select('skor_soal')->join('soal', 'soal.id_soal', '=', 'jawab.id_soal')->where('nis_siswa = ? AND id_jadwal = ? AND hasil_jawab = ?', [$row->nis_siswa, $row->id_jadwal, 1])->get();
  if (is_array($jawab)) {
    foreach ($jawab as $key => $value) {
      $nilai = $nilai + $value->skor_soal;
    }
  }
  $kkm = $row->kkm_mapel;
  if ($nilai == 0) {
    $belum = $belum + 1;
  } elseif ($nilai < $kkm/2) {
    $gagal = $gagal + 1;
  } elseif ($nilai < $kkm) {
    $tidaklulus = $tidaklulus + 1;
  } else {
    $lulus = $lulus + 1;
  }

}
?>
<script type="text/javascript">
  $(document).ready( function() {

    var barSiswa = $('#barSiswa');
    var barSiswa = new Chart(barSiswa, {
        type: 'bar',
        data: {
            labels: [
              <?php
                $label = '';
                foreach ($tahun as $key => $value) {
                  $label .= '"'.$value->nama_tahunajaran.'", ';
                }
                echo substr($label, 0, -2);
               ?>
            ],
            datasets: [
                {
                    label: "Total",
                    backgroundColor: [
                        'rgba(96, 125, 139, 0.6)',
                        'rgba(96, 125, 139, 0.6)',
                        'rgba(96, 125, 139, 0.6)',
                        'rgba(96, 125, 139, 0.6)',
                        'rgba(96, 125, 139, 0.6)',
                        'rgba(96, 125, 139, 0.6)',
                        'rgba(96, 125, 139, 0.6)',
                        'rgba(96, 125, 139, 0.6)',
                        'rgba(96, 125, 139, 0.6)',
                        'rgba(96, 125, 139, 0.6)',
                    ],
                    borderColor: [
                        'rgba(96, 125, 139, 1)',
                        'rgba(96, 125, 139, 1)',
                        'rgba(96, 125, 139, 1)',
                        'rgba(96, 125, 139, 1)',
                        'rgba(96, 125, 139, 1)',
                        'rgba(96, 125, 139, 1)',
                        'rgba(96, 125, 139, 1)',
                        'rgba(96, 125, 139, 1)',
                        'rgba(96, 125, 139, 1)',
                        'rgba(96, 125, 139, 1)',
                    ],
                    borderWidth: 1,
                    data: [
                       <?php
                       $db->table('jawab')->selfJoin($field)->where('kbm.register_petugas', $_SESSION['user_petugas'])->get();
                       echo $db->num_rows();
                       ?>
                    ],
                },
                {
                    label: "Tidak Jawab",
                    backgroundColor: [
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                    ],
                    borderColor: [
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                    ],
                    borderWidth: 1,
                    data: [
                       <?php
                       $db->table('jawab')->selfJoin($field)->where('kbm.register_petugas = ? AND hasil_jawab = ?', [$_SESSION['user_petugas'], 0])->get();
                       echo $db->num_rows();
                       ?>
                    ],
                },
                {
                    label: "Benar",
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1,
                    data: [
                       <?php
                       $db->table('jawab')->selfJoin($field)->where('kbm.register_petugas = ? AND hasil_jawab = ?', [$_SESSION['user_petugas'], 1])->get();
                       echo $db->num_rows();
                       ?>
                    ],
                },
                {
                    label: "Salah",
                    backgroundColor: [
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                    ],
                    borderColor: [
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                    ],
                    borderWidth: 1,
                    data: [
                       <?php
                       $db->table('jawab')->selfJoin($field)->where('kbm.register_petugas = ? AND hasil_jawab = ?', [$_SESSION['user_petugas'], 2])->get();
                       echo $db->num_rows();
                       ?>
                    ],
                }
            ]
        }
    });
    var PIECHARTEXMPLE    = $('#pieKelulusan');
    var brandPrimary = 'rgba(51, 179, 90, 1)';
    var pieKelulusan = new Chart(PIECHARTEXMPLE, {
        type: 'doughnut',
        data: {
            labels: [
                "Lulus",
                "Tidak Lulus",
                "Gagal",
                "Belum Ujian",
            ],
            datasets: [
                {
                    data: [<?= $lulus; ?>, <?= $tidaklulus; ?>, <?= $gagal; ?>, <?= $belum; ?>],
                    borderWidth: [1, 1, 1, 1],
                    backgroundColor: [
                        "rgba(51, 179, 90, 1)",
                        "rgba(75,192,192,1)",
                        "#FFCE56",
                        "rgba(158, 158, 158, 1)"
                    ],
                    hoverBackgroundColor: [
                        "rgba(51, 179, 90, 1)",
                        "rgba(75,192,192,1)",
                        "#FFCE56",
                        "rgba(158, 158, 158, 1)"
                    ]
                }]
            }
    });

    var pieKelulusan = {
        responsive: true
    };

    $('#boxsoal').click( function() {
      $('#menupage').load('resource/views/soal/guru/_home.php', {page: '<?= token(32); ?>'});
      $('.menuActive').removeClass('active');
      $('.pageRemove').remove();
      $('#Acsoal').addClass('active');
      changeurl('soal.php');
    });
    $('#boxjawab').click( function() {
      $('#menupage').load('resource/views/jawab/_home.php', {page: '<?= token(32); ?>'});
      $('.menuActive').removeClass('active');
      $('.pageRemove').remove();
      $('#Acjawab').addClass('active');
      changeurl('jawab.php');
    });
  });
</script>
