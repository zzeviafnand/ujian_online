<a onclick="changeurl('soal.php?soal=show&id=<?= $_GET['edit']; ?>');" id="detail" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
<p></p>
<?php
require_once __DIR__.'/../../../../app/config.php';
  if (Input::get('perbarui')) {
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
      ];
      $db->table('soal')->where('id_soal', $_POST['id'])->update($fields);
      for ($i=0; $i < count($_POST['idJawab']); $i++) {
        $db->table('soaljawab')->where('id_soaljawab', $_POST['idJawab'][$i])->update(['text_soaljawab' => $_POST['jawab'][$i], 'kunci_soaljawab' => $key[$i]]);
      }
      $msg->success('Soal berhasil diperbarui', '?soal=show&id='.$_GET['edit']);
    }else $msg->info('Kolom tidak boleh kosong', '?soal=show&edit='.$_GET['edit'].'&id='.$_POST['id']);
  }else {
    $posts = $db->table('soal')->join('kbm', 'kbm.id_kbm', '=', 'soal.id_kbm')->where('id_soal = ? AND register_petugas = ?', [$_GET['id'], $_SESSION['user_petugas']])->get();
    if (is_array($posts)) {
      foreach ($posts as $key => $rows);

?>
<script src="public/ckeditor/ckeditor.js" charset="utf-8"></script>
<form class="was-validated" action="" method="post">
  <input type="hidden" name="id" value="<?= $rows->id_soal; ?>">
  <div class="row">
    <div class="col-md-9">
      <div class="form-group">
        <label for="text">Pertanyaan</label>
        <textarea name="text" id="text" rows="8" cols="80" class="form-control ckeditor"><?= $rows->text_soal; ?></textarea>
      </div>
      <?php if ($rows->kategori_soal == 1): ?>
        <?php
        $array = [1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E'];
        $posts = $db->table('soaljawab')->where('id_soal', $rows->id_soal)->get();
        $a = 1;
        if (is_array($posts)) {
          foreach ($posts as $key => $val) {
            $check = ($val->kunci_soaljawab == 1) ? 'checked' : '';?>
            <div class="row">
              <input type="hidden" name="idJawab[]" value="<?= $val->id_soaljawab; ?>">
              <div class="col-md-11">
                <div class="form-group">
                  <label for="jawab">Jawaban <?= $array[$a]; ?></label>
                  <textarea name="jawab[]" id="jawab<?= $a; ?>" class="form-control ckeditor" rows="8" cols="80"><?= $val->text_soaljawab; ?></textarea>
                  <script type="text/javascript">
                  CKEDITOR.replace('jawab<?= $a; ?>');
                  </script>
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label for="">Pilih</label><br>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="kunci[]" id="kunci<?= $a;  ?>" value="<?= $array[$a]; ?>" class="custom-control-input" <?= $check; ?>>
                    <label class="custom-control-label" for="kunci<?= $a;  ?>">Benar</label>
                  </div>
                </div>
              </div>
            </div>
          <?php $a++; }} ?>
      <?php endif; ?>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="kategori">Kategori Soal</label><br>
        <div class="custom-control custom-radio custom-control-inline">
          <?php
            $jk = '';
            $jk2 = '';
            if (isset($_POST['kategori'])) {
              if ($_POST['kategori'] == 2 || $rows->kategori_soal == 2) {
                $jk2 = 'checked';
              } else {
                $jk = 'checked';
              }
            }else {
              if ($rows->kategori_soal == 2) {
                $jk2 = 'checked';
              } else {
                $jk = 'checked';
              }
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
        <input type="number" name="skor" id="skor" class="form-control" value="<?= $rows->skor_soal; ?>" required>
      </div>
      <div class="form-group">
        <input type="submit" name="perbarui" class="btn btn-sm btn-success btn-block" value="Edit">
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
    $('#tampil').load('resource/views/soal/guru/_detail.php?id=<?= $_GET['edit']; ?>');
  });
</script>

<?php
    }else {
      $msg->warning('Maaf!, Anda melakukan kecurangan dengan mengganti kunci id soal');
      $msg->display();
    }
  }
?>
