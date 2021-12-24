<?php if (isset($_POST['page'])): ?>
  <section class="dashboard-counts section-padding">
    <div class="container-fluid">
      <div class="row text-white">
        <div class="col-sm-6">
          <div class="small-box bg-primary"id="boxsiswa">
            <div class="inner">
              <?php
                $db->table('siswa')->get();
                echo '<h3>'.$db->num_rows().'</h3>';
              ?>
              <p>Siswa</p>
            </div>
            <div class="icon">
              <i class="fa fa-child"></i>
            </div>
            <a class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="small-box bg-primary"id="boxjadwal">
            <div class="inner">
              <?php
                $db->table('jadwal')->get();
                echo '<h3>'.$db->num_rows().'</h3>';
              ?>
              <p>Jadwal</p>
            </div>
            <div class="icon">
              <i class="fa fa-clipboard"></i>
            </div>
            <a class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h4>Syarat Akses Proktor</h4>
        </div>
        <div class="card-body">
          <article class="text-justify">
            <p>Syarat Proktor dalam menjalankan tugasnya</p>
            <ol>
              <li>Dilarang keras melakukan pemberian izin pengaturan jadwal</li>
              <li>Memiliki kartu ujian</li>
              <li>Memiliki kartu ujian</li>
              <li>Memiliki kartu ujian</li>
              <li>Memiliki kartu ujian</li>
              <li>Memiliki kartu ujian</li>
            </ol>
          </article>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">
    $('#boxsiswa').click( function() {
      $('#menupage').load('resource/views/siswa/proktor/_home.php', {page: '<?= token(32); ?>'});
      $('.menuActive').removeClass('active');
      $('.pageRemove').remove();
      $('#Acsiswa').addClass('active');
      changeurl('siswa.php');
    });
    $('#boxjadwal').click( function() {
      $('#menupage').load('resource/views/jadwal/_home.php', {page: '<?= token(32); ?>'});
      $('.menuActive').removeClass('active');
      $('.pageRemove').remove();
      $('#Acjadwal').addClass('active');
      changeurl('jadwal.php');
    });
  </script>
<?php endif; ?>
