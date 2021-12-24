<?php if (isset($_POST['id'])): require_once __DIR__.'/../../../app/config.php'; ?>
	<div class="mb-4">
    <div class="btn-group float-right" role="group">
      <button id="download" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-download"></span> Download
      </button>
      <div class="dropdown-menu" aria-labelledby="download">
        <button onclick="changeurl('guru.php?guru=download&id=print');" id="print" type="button" class="dropdown-item btn-light"><span class="fa fa-print"></span> Print</button>
        <button onclick="changeurl('guru.php?guru=download&id=pdf');" id="pdf" type="button" class="dropdown-item btn-light"><span class="fa fa-file-pdf"></span> PDF</button>
        <button onclick="changeurl('guru.php?guru=download&id=xls');" id="excel" type="button" class="dropdown-item btn-light"><span class="fa fa-file-excel"></span> XLS</button>
      </div>
    </div>
    <a onclick="changeurl('jawab.php');" id="home" class="btn btn-sm btn-dark"><i class="fa fa-reply"></i> Back</a>
    <button type="button" id="reload" class="btn btn-sm btn-white"><span class="fa fa-sync-alt"></span> Reload</button>
  </div>
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label for="lenghtRows">Show</label>
        <select class="form-control-sm" id="lenghtRows">
          <optgroup label="Pilih Tampilan">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </optgroup>
        </select>
      </div>
    </div>
    <div class="col-sm-7"></div>
    <div class="col-sm-3">
      <div class="form-group">
        <label for="kategori">Kategori Soal</label>
        <select class="form-control-sm" id="kategori">
          <optgroup label="Pilih Kategori Soal">
            <option value="all">All soal</option>
            <option value="1">Objektif</option>
            <option value="2">Essay</option>
          </optgroup>
        </select>
      </div>
    </div>
  </div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Soal</th>
					<th>Jawab</th>
					<th>Hasil</th>
				</tr>
			</thead>
			<tbody id="tampiljawabsiswa">

			</tbody>
		</table>
	</div>
	<script type="text/javascript">
		$(document).ready( function() {
			$("#tampiljawabsiswa").load('resource/views/jawab/inc/_jawabsiswa.php', {nis: '<?= $_POST['id']; ?>'});
			$('#home').click( function() {
				$('#tampil').load('resource/views/jawab/_show.php', {page: '<?= token(32); ?>'});
			});
			$('#reload').click( function() {
				$('#tampil').load('resource/views/jawab/_detail.php', {id: '<?= $_POST['id']; ?>'});
			});
			$("#lenghtRows").change( function() {
				$.ajax({
					type: "POST",
					url: "resource/views/jawab/inc/_jawabsiswa.php",
					data: {
						nis: '<?= $_POST['id']; ?>',
						rows: $("#lenghtRows").val(),
						kategori: $("#kategori").val()
					},
					cache: false,
					success: function(data) {
						$("#tampiljawabsiswa").html(data);
					}
				});
			});
			$("#kategori").change( function() {
				$.ajax({
					type: "POST",
					url: "resource/views/jawab/inc/_jawabsiswa.php",
					data: {
						nis: '<?= $_POST['id']; ?>',
						rows: $("#lenghtRows").val(),
						kategori: $("#kategori").val()
					},
					cache: false,
					success: function(data) {
						$("#tampiljawabsiswa").html(data);
					}
				});
			});
		});
	</script>
<?php endif; ?>
