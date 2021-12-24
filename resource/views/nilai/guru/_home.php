<?php if (isset($_POST['page'])): require_once __DIR__.'/../../../../app/config.php';?>
  <!-- Breadcrumb-->
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item menuhome"><a class=" text-primary">Dashboard</a></li>
        <li class="breadcrumb-item active">Nilai Siswa</li>
      </ul>
    </div>
  </div>
  <section class="forms pt-4">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h4>Nilai <span id="tampilpage"></span> </h4>
        </div>
        <div class="card-body" id="tampil">
          <?php
            $page = ($_POST['page'] == 'siswa' || $_POST['page'] == 'pengajar') ? $_POST['page'] : decode($_POST['page']);
            if ($page == 'siswa') {
              require_once '_siswa.php';
            } elseif ($page == 'pengajar') {
              require_once '_pengajar.php';
            }
          ?>
        </div>
      </div>
    </div>
  </section>
  <?php require_once __DIR__.'/../../data/_menuhome.php'; ?>
<?php endif; ?>
