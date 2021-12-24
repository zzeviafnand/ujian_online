<?php
if (isset($_POST['nilai'])) {
  require_once __DIR__.'/../../../../app/config.php';

  $nilai = $_POST['nilai'];
  $db->table('jawab')->where('id',decode($_POST['id']))->update(['hasil_jawab' => $nilai]);
  if ($nilai == 1) {
    echo '<span class="fa fa-smile"></span> Benar';
  } elseif ($nilai == 2) {
    echo '<span class="fa fa-angry"></span> Salah';
  } else {
    echo '<span class="fa fa-meh"></span> Setengah';
  }

}
