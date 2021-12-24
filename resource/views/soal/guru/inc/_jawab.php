<div class="row" id="datajawab">
<?php
if (isset($_GET['jawab'])) {
  $jumlah = $_GET['jawab'];
}else {
  $jumlah = 5;
}
$array = [1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E'];
for ($i=1; $i <= $jumlah; $i++) { ?>
  <div class="col-md-11">
    <div class="form-group">
      <label for="jawab">Jawaban <?= $array[$i]; ?></label>
      <textarea  name="jawab[]" id="jawab<?= $i; ?>" class="form-control" rows="8" cols="80" required></textarea>
      <script type="text/javascript">
        CKEDITOR.replace('jawab<?= $i; ?>');
      </script>
    </div>
  </div>
  <div class="col-md-1">
    <div class="form-group">
      <label for="">Pilih</label><br>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" name="kunci[]" id="kunci<?= $i;  ?>" value="<?= $array[$i]; ?>" class="custom-control-input">
        <label class="custom-control-label" for="kunci<?= $i;  ?>">Benar</label>
      </div>
    </div>
  </div>
<?php } ?>
</div>
