<?php
require_once __DIR__.'/../../../../app/config.php';

if (Input::get('simpan')) {
  if (Input::empty('text')) {
    $array = ['A', 'B', 'C', 'D', 'E'];
    $kunci = $_POST['kunci'][0];
    $key = [];

    for ($i=0; $i < count($_POST['jawab']); $i++) {
      $a = $array[$i];
      if ($kunci == $a){$key[$i] = 1;}else{$key[$i] = 0;}
    }

    $fields = [
      'text_soal' => Input::get('text'),
      'kategori_soal' => Input::get('kategori'),
      'skor_soal' => Input::get('skor'),
      'id_kbm' => $_POST['id'],
    ];

    $db->table('soal')->insert($fields);
    $id = $db->insert_id();
    for ($i=0; $i < count($_POST['jawab']); $i++) {
      $db->table('soaljawab')->insert(['text_soaljawab' => $_POST['jawab'][$i], 'kunci_soaljawab' => $key[$i], 'id_soal' => $id]);
    }
    $msg->success('Soal berhasil tersimpan', '?soal=show&tambah&id='.$_POST['id']);
  }else $msg->info('Kolom tidak boleh kosong', '?soal=show&tambah&id='.$_POST['id']);
}
?>
<script src="public/ckeditor/ckeditor.js" charset="utf-8"></script>
<a onclick="changeurl('soal.php?soal=show&id=<?= $_GET['id']; ?>');" id="detail" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
<p></p>
<form class="was-validated" action="" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= (isset($_GET['id'])) ? $_GET['id'] : ''; ?>">
  <div class="row">
    <div class="col-md-9">
      <div class="form-group">
        <label for="text">Pertanyaan</label>
        <textarea name="text" id="text" rows="8" cols="80" class="form-control" required></textarea>
      </div>
      <div id="showsoaljawab" class="card-body">
        <?php
          require_once 'inc/_jawab.php';
         ?>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="kategori">Kategori Soal</label><br>
        <div class="custom-control custom-radio custom-control-inline">
          <?php
            $jk = '';
            $jk2 = '';
            if (isset($_POST['kategori'])) {
              if ($_POST['kategori'] == 2) {
                $jk2 = 'checked';
              } else {
                $jk = 'checked';
              }
            }else {
              $jk = 'checked';
            }
           ?>
          <input type="radio" name="kategori" id="kategori1" value="1" class="custom-control-input" required <?= $jk; ?>>
          <label class="custom-control-label" for="kategori1">Objektif</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" name="kategori" id="kategori2" value="2" class="custom-control-input" required <?= $jk2; ?>>
          <label class="custom-control-label" for="kategori2">Essay</label>
        </div>
      </div>
      <div class="form-group">
        <label for="skor">Skor</label>
        <input type="number" name="skor" id="skor" rows="8" cols="80" class="form-control" required>
      </div>
      <div class="form-group" id="datajumlah">
        <label for="jumlah">Jumlah Jawaban</label><br>
        <?php
        $jk = '';
        $jk2 = '';
        if (isset($_POST['kategori'])) {
          if ($_POST['kategori'] == 2) {
            $jk2 = 'checked';
          } else {
            $jk = 'checked';
          }
        }else {
          $jk2 = 'checked';
        }
        ?>
        <div class="custom-control custom-radio custom-control-inline soaljawab">
          <input type="radio" name="jumlah" id="jumlah1" value="4" class="custom-control-input" required <?= $jk; ?>>
          <label class="custom-control-label" for="jumlah1">4 Jawaban</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline soaljawab">
          <input type="radio" name="jumlah" id="jumlah2" value="5" class="custom-control-input" required <?= $jk2; ?>>
          <label class="custom-control-label" for="jumlah2">5 Jawaban</label>
        </div>
      </div>
      <div class="form-group">
        <input type="submit" name="simpan" class="btn btn-sm btn-success btn-block" value="Save">
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  var editor = CKEDITOR.replace('text', {
    filebrowserBrowseUrl : '/public/ckfinder/ckfinder.html',
    filebrowserUploadUrl : '/public/ckfinder/core/connector/php/connector.php',
    filebrowserWindowWitdh: '1000',
    filebrowserWindowHeight: '700'
  });
  $('#detail').click( function() {
    $('#tampil').load('resource/views/soal/guru/_detail.php?id=<?= $_GET['id']; ?>');
  });
  $(".soaljawab input").click( function() {
    var jum = $(this).attr('value');
    $('#showsoaljawab').load('resource/views/soal/guru/inc/_jawab.php?jawab='+jum);
    changeurl('soal.php?soal=show&tambah&id=<?= $_GET['id']; ?>&jawab='+jum);
  });
  $('#kategori1').click( function() {
    $('#showsoaljawab').load('resource/views/soal/guru/inc/_jawab.php');
    $('#datajumlah').show();
  });
  $('#kategori2').click( function() {
    $('#datajumlah').hide();
    $('#datajawab').remove();
  });
</script>
