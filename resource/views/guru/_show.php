<?php if (isset($_POST['page'])): require_once __DIR__.'/../../../app/config.php'; ?>
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
    <a onclick="changeurl('guru.php?page=tambah');" id="tambah" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Guru</a>
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
        <input type="text" id="search" class="form-control form-control-sm" placeholder="Search guru...">
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover" id="datatables">
      <thead>
        <tr>
          <th>#</th>
          <th class="col-th-4">Nomor Register</th>
          <th class="col-th-4">NIP/K</th>
          <th class="col-th-4">Nama Guru</th>
          <th class="col-th-5">Tempat/Tanggal Lahir</th>
          <th class="col-th-3">Jenis Kelamin</th>
          <th class="col-th-2">Telepon</th>
          <th class="col-th-5">Alamat</th>
          <th id="table-th-3">Aksi</th>
        </tr>
      </thead>
      <tbody id="tampilguru">

      </tbody>
    </table>
  </div>
    <script type="text/javascript">
    $(document).ready( function() {
      $('#tambah').click( function() {
        $('#tampil').load('resource/views/guru/_add.php', {page: '<?= token(32); ?>'});
      });
      $('#reload').click( function() {
        $('#tampil').load('resource/views/guru/_show.php', {page: '<?= token(32); ?>'});
        changeurl('guru.php');
      });
      $('#tampilguru').load('resource/views/guru/inc/_guru.php', {
        rows: $('#lenghtRows').find(":selected").val()
      });

      $('#lenghtRows').change( function() {
        $('#tampilguru').load('resource/views/guru/inc/_guru.php', {
          rows: $(this).val(),
          search: $('#search').val(),
        });
      }); // end Rows
      $('#search').on('keyup', function() {
        var search = $(this).val();
        if (search == '') {
          changeurl('guru.php');
        } else {
          changeurl('guru.php?siswa=search&name='+search);
        }
        $('#tampilguru').load('resource/views/guru/inc/_guru.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          search: search
        });
      });
      /**
      * Data Download
      */
      $('#excel').click( function() {
        $('#datatables').table2excel({
          filename: 'Laporan Data Guru'
        });
      });
    });
  </script>
<?php endif; ?>
