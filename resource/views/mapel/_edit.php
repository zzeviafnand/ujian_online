<?php if (isset($_POST['id'])): ?>
  <?php
  require_once __DIR__.'/../../../app/config.php';
  foreach ($db->table('mapel')->where('id_mapel', decode($_POST['id']))->get() as $rows);
  ?>
  <a  onclick="changeurl('mapel.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
  <p></p>
  <form class="was-validated" action="" method="post">
    <input type="hidden" id="id" value="<?= $rows->id_mapel; ?>">
    <div class="form-group">
      <label for="nama">Nama Mapel</label>
      <input type="text" name="nama" id="nama" class="form-control" value="<?= $rows->nama_mapel; ?>" required>
    </div>
    <div class="form-group">
      <label for="kategori">Kategori</label>
      <select class="form-control" name="kategori" id="kategori" required>
        <optgroup label="Pilih Kategori">
          <option value="<?= (empty($_POST['kategori'])) ? $rows->kategori_mapel: $_POST['kategori']; ?>" hidden><?= kateMapel((empty($_POST['kategori'])) ? $rows->kategori_mapel : $_POST['kategori']); ?></option>
          <?php for ($i=1; $i <= 3 ; $i++) { ?>
            <option value="<?= $i; ?>"><?= kateMapel($i); ?></option>
          <?php } ?>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <label for="kkm">KKM</label>
      <input type="number" name="kkm" id="kkm" class="form-control" value="<?= $rows->kkm_mapel; ?>" required>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-sm btn-success btn-block"><span class="fa fa-edit"></span> Edit</button>
    </div>
  </form>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#home').click( function() {
        $('#tampil').load('resource/views/mapel/_show.php', {page: '<?= token(32); ?>'});
      });
      $('form').submit( function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'resource/views/mapel/inc/_update.php',
          data: {
            id: $('#id').val(),
            nama: $('#nama').val(),
            kategori: $('#kategori').val(),
            kkm: $('#kkm').val()
          },
          cache: false,
          success: function(response) {
            $('#tampil').load('resource/views/mapel/_show.php', {page: '<?= token(32); ?>'});
            changeurl('mapel.php');
            return getMessages();
          }
        });
      });
    });
  </script>
<?php endif; ?>
