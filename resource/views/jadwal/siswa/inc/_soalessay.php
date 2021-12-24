<div class="form-group">
  <label for="soalEssay">Silakan jawab soal essay</label>
  <?php
  $jawab = $db->table('jawab')->join('soaljawab', 'soaljawab.id_soaljawab', '=', 'jawab.id_soaljawab')->where('nis_siswa = ? AND id_jadwal = ? AND jawab.id_soal = ?', [$_SESSION['role_siswa'], $jadwal, $soal->id_soal])->get();
  if (is_array($jawab)) {
    foreach ($jawab as $key => $value) {
      if ($value->id_soaljawab == null) {
        echo '<textarea id="soalEssay" rows="8" class="form-control" cols="80" placeholder="Isi dengan jawaban yang benar..."></textarea>';
      }else {
        echo '<textarea id="soalEssay" rows="8" class="form-control" cols="80" placeholder="Isi dengan jawaban yang benar...">'.$value->text_soaljawab.'</textarea>';
      }
    }
  }else {
    echo '<textarea id="soalEssay" rows="8" class="form-control" cols="80" placeholder="Isi dengan jawaban yang benar..."></textarea>';
  }
  ?>
</div>
