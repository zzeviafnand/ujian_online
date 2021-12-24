<?php require_once 'resource/template/header.php';?>
<div id="menupage">
<?php
if (isset($_SESSION['role_petugas'])) {
  $s = $_SESSION['role_petugas'];
  if ($s == 1 || $s == 2) {?>
    <script type="text/javascript">
    $('#menupage').load('resource/views/nilai/_home.php', {
      page: '<?= (isset($_GET['page'])) ? $_GET['page'] : ''; ?>',
      id: '<?= (isset($_GET['id'])) ? $_GET['id'] : ''; ?>',
    });
    </script>
    <?php
  }elseif ($s == 3) {?>
    <script type="text/javascript">
    $('#menupage').load('resource/views/nilai/guru/_home.php', {
      page: '<?= (isset($_GET['page'])) ? $_GET['page'] : ''; ?>',
      id: '<?= (isset($_GET['id'])) ? $_GET['id'] : ''; ?>',
    });
    </script>
    <?php
  } else {
    require_once 'resource/views/data/404.php';
  }
} else {
  require_once 'resource/views/data/404.php';
}
?>
</div>
<?php require_once 'resource/template/footer.php'; ?>
<script type="text/javascript">
  $('.menuActive').removeClass('active');
  $('#Acnilai').addClass('active');
</script>
