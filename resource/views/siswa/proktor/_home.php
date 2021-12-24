<?php if (isset($_POST['page'])): ?>
  <!-- Breadcrumb-->
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item menuhome"><a class=" text-primary">Dashboard</a></li>
        <li class="breadcrumb-item active">Siswa</li>
      </ul>
    </div>
  </div>
  <section class="forms pt-4">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h4>Siswa</h4>
        </div>
        <div class="card-body" id="tampil">
          <?php
          // $page ($_GET['page'] == '') ? '' : $_GET['page'];
          if ($_POST['page'] == 'edit') {
            require_once '_edit.php';
          } else {
            require_once '_show.php';
          }
          ?>
        </div>
      </div>
    </div>
  </section>
  <?php require_once __DIR__.'/../../data/_menuhome.php'; ?>
<?php endif; ?>