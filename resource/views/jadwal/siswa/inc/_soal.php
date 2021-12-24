<?php
require_once __DIR__.'/../../../../../app/config.php';
if (isset($_POST['siswa']) && isset($_POST['jadwal'])) {
  $jadwal = decode($_POST['jadwal']);
  $siswa = decode($_POST['siswa']);
  $page = (isset($_POST['page'])) ? $_POST['page'] : 1;
  $posts = $db->table('jawab')->join('soal', 'soal.id_soal', '=', 'jawab.id_soal')->pagination(1, $page)->where('nis_siswa = ? AND id_jadwal = ?', [$siswa, $jadwal])->get();
  if (is_array($posts)) {
    foreach ($posts as $key => $soal) {
      $_SESSION['soal'] = encode($soal->id_soal);
  ?>
  <div class="card-body text-justify">
    <article class="soal-article">
      <?= $soal->text_soal; ?>
    </article>
    <?php
      if ($soal->kategori_soal == 1) {
        require_once '_soalobjektif.php';
      } else {
        require_once '_soalessay.php';
      }
    ?>
  </div>
  <!-- End card body -->
  <div class="card-footer" id="pagination">
    <?php
    $db->table('jawab')->where('nis_siswa = ? AND id_jadwal = ?',[$siswa, $jadwal])->get();

    $num = $db->num_rows();
    ?>
    <button type="button" class="btn btn-sm btn-dark" value="<?= $page-1; ?>" <?php if($page == 1){ echo "disabled"; } ?>>
      <span class="fa fa-arrow-left"></span> Sebelumnya
    </button>
    <button type="button" class="btn btn-sm float-right btn-info" value="<?= $page+1; ?>"<?php if($page == $num){ echo "disabled"; } ?>>
      Selanjutnya <span class="fa fa-arrow-right"></span>
    </button>
  </div>
  <!-- End card footer -->
  <?php }} ?>
  <script type="text/javascript">
    $(document).ready( function() {
      changeurl("jadwal.php?jadwal=<?= encode($jadwal); ?>&soal=<?= $_SESSION["soal"];?>");
      $("#soalObjektif input").click( function() {
        // Memilih daftar soal tersisi
        $("#nomorSoal<?= $page;?>").removeClass("btn-warning");
        $("#nomorSoal<?= $page;?>").addClass("btn-primary");
        // END Memilih daftar soal tersisi
        changeurl("jadwal.php?jadwal=<?= encode($jadwal); ?>&soal=<?= $_SESSION["soal"];?>&jawab="+$(this).attr("value"));
        $.ajax({
          type: "POST",
          url: "resource/views/jadwal/siswa/inc/_jawabObjektif.php",
          data: {
            siswa: "<?= encode($siswa); ?>",
            soal: "<?= $_SESSION["soal"]; ?>",
            soaljawab: $(this).attr("value")
          },
          cache: false,
          success: function(data) {
          }
        });
      });
      $("#soalEssay").on("keyup", function() {
        var jawab = $("#soalEssay").val();
        // Memilih daftar soal tersisi
        if (jawab == "") {
          $("#nomorSoal<?= $page;?>").removeClass("btn-primary");
          $("#nomorSoal<?= $page;?>").addClass("btn-warning");
        }else {
          $("#nomorSoal<?= $page;?>").removeClass("btn-warning");
          $("#nomorSoal<?= $page;?>").addClass("btn-primary");
        }
        $.ajax({
          type: "POST",
          url: "resource/views/jadwal/siswa/inc/_jawabEssay.php",
          data: {
            siswa: "<?= encode($siswa); ?>",
            soal: "<?= $_SESSION["soal"]; ?>",
            soaljawab:jawab
          },
          cache: false,
          success: function(data) {
          }
        });
      });
      $("#pagination button").click( function() {
        $(this).removeAttr("disabled");
        $("#tampilnomor").text($(this).attr("value"));
        $.ajax({
          type: "POST",
          url: "resource/views/jadwal/siswa/inc/_soal.php",
          data: {
            siswa: "<?= encode($siswa); ?>",
            jadwal: "<?= encode($jadwal); ?>",
            page: $(this).attr("value")
          },
          cache: false,
          success: function(response){
            $("#tampilsoal").html(response);
          }
        });
      });
    });
  </script>
<?php } ?>
