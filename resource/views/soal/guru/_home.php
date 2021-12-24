<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item menuhome"><a class=" text-primary">Dashboard</a></li>
      <li class="breadcrumb-item active" onclick="return confirm('njnjnjs');">Soal</li>
    </ul>
  </div>
</div>
<section class="forms pt-4">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h4>Soal</h4>
      </div>
      <div class="card-body" id="tampil">
<?php
  $page = (isset($_GET['soal'])) ? $_GET['soal'] : '';
  if ($page == 'show') {
    if (isset($_GET['tambah'])) {
      require_once '_add.php';
    } elseif (isset($_GET['edit'])) {
      require_once '_edit.php';
    } else {
      require_once '_detail.php';
    }
  } else {
    require_once '_show.php';
  }
?>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__.'/../../data/_menuhome.php'; ?>
