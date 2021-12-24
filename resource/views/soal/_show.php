<div class="mb-4">
  <div class="btn-group float-right" role="group">
    <button id="download" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-download"></span> Download
    </button>
    <div class="dropdown-menu" aria-labelledby="download">
      <button onclick="changeurl('soal.php?soal=download&id=print');" id="print" type="button" class="dropdown-item btn-light"><span class="fa fa-print"></span> Print</button>
      <button onclick="changeurl('soal.php?soal=download&id=pdf');" id="pdf" type="button" class="dropdown-item btn-light"><span class="fa fa-file-pdf"></span> PDF</button>
      <button onclick="changeurl('soal.php?soal=download&id=xls');" id="excel" type="button" class="dropdown-item btn-light"><span class="fa fa-file-excel"></span> XLS</button>
    </div>
  </div>
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
  <div class="col-sm-8"></div>
  <div class="col-sm-2">
    <div class="form-group">
      <select class="form-control form-control-sm" id="mapel">
        <optgroup label="Pilih Mapel">
          <option value="all">All Mapel</option>
          <?php
          require_once __DIR__.'/../../../app/config.php';
          foreach ($db->table('mapel')->orderBy('nama_mapel')->get() as $key => $row) {?>
            <option value="<?= $row->id_mapel; ?>"><?= $row->nama_mapel; ?></option>
          <?php } ?>
        </optgroup>
      </select>
    </div>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped table-hover" id="datatables">
    <thead>
      <tr>
        <th>#</th>
        <th class="col-th-4">Mapel</th>
        <th class="col-th-3">Guru</th>
        <th class="col-th-3">Jumlah Soal</th>
        <th id="table-th-2">Aksi</th>
      </tr>
    </thead>
    <tbody id="tampilsoal">

    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready( function() {
    $('#reload').click( function() {
      $('#tampil').load('resource/views/soal/_show.php');
      changeurl('soal.php');
    });
    $('#tampilsoal').load('resource/views/soal/inc/_soal.php', {
      mapel: $('#mapel').val()
    });

    $('#lenghtRows').change( function() {
      $('#tampilsoal').load('resource/views/soal/inc/_soal.php', {
        rows: $(this).val(),
        mapel: $('#mapel').val(),
      });
    }); // end Rows
    $('#mapel').change( function() {
      $('#tampilsoal').load('resource/views/soal/inc/_soal.php', {
        rows: $('#lenghtRows').find(":selected").val(),
        mapel: $(this).val()
      });
    });
    /**
    * Data Download
    */
    $('#excel').click( function() {
      $('#datatables').table2excel({
        filename: 'Laporan Data Soal'
      });
    });
  });
</script>
