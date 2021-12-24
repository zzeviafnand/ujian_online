<?php require_once __DIR__.'../../../app/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ujian Online - SMK Hasanah</title>
  <script src="public/js/jquery-3.3.1.min.js" charset="utf-8"></script>
  <div id="style"></div>
  <script type="text/javascript">
    $('#style').load('resource/template/style.php');
    function changeurl(url) {
      window.history.pushState('Data', 'Title', 'http://<?= $_SERVER['HTTP_HOST']; ?>/'+url);
      document.title = url+' - SMK Hasanah';
    }
    function requestUrl(url, id = null) {
      $.ajax({
        type: "POST",
        url: url,
        data: {page: '<?= token(32); ?>', id: id},
        dataType: "json",
        success: function(data) {
          $("#tampil").html(data.htmlentities);
        }
      });
    }
  </script>
</head>
<body>
<div id="messages"></div>
<!-- <div class="loading-gif"></div> -->
  <?php require_once 'sidebar.php'; ?>
  <div class="page">
  <?php require_once 'navbar.php'; ?>
