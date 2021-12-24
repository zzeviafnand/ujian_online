<?php
  $j = 1;
  $array = [1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E'];
  foreach ($db->table('jawab')->where('id_soal = ? AND nis_siswa = ?', [$soal->id_soal, $_SESSION['role_siswa']])->get() as $key => $jawab);
  $post = $db->table('soaljawab')->where('id_soal', $soal->id_soal)->get();
  if (is_array($post)) {
  foreach ($post as $key => $soaljawab) {
?>
<div class="form-group">
  <div class="custom-control custom-radio custom-control-inline" id="soalObjektif">
    <?php if ($jawab->id_soaljawab == $soaljawab->id_soaljawab): ?>
      <input type="radio" name="jawab" id="jawab<?= $array[$j]; ?>" value="<?= encode($soaljawab->id_soaljawab); ?>" class="custom-control-input" checked required>
    <?php else: ?>
      <input type="radio" name="jawab" id="jawab<?= $array[$j]; ?>" value="<?= encode($soaljawab->id_soaljawab); ?>" class="custom-control-input" required>
    <?php endif; ?>
    <label class="custom-control-label" for="jawab<?= $array[$j]; ?>">
      <?= $array[$j].') '. $soaljawab->text_soaljawab; $j++; ?>
    </label>
  </div>
</div>
<?php }} ?>
