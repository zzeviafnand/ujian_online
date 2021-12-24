<?php if (isset($_POST['page'])): ?>
  <div class="mb-4">
    <div class="btn-group float-right" role="group">
      <button id="download" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-download"></span> Download
      </button>
      <div class="dropdown-menu" aria-labelledby="download">
        <button onclick="changeurl('jadwal.php?jadwal=download&id=print');" id="print" type="button" class="dropdown-item btn-light"><span class="fa fa-print"></span> Print</button>
        <button onclick="changeurl('jadwal.php?jadwal=download&id=pdf');" id="pdf" type="button" class="dropdown-item btn-light"><span class="fa fa-file-pdf"></span> PDF</button>
        <button onclick="changeurl('jadwal.php?jadwal=download&id=xls');" id="excel" type="button" class="dropdown-item btn-light"><span class="fa fa-file-excel"></span> XLS</button>
      </div>
    </div>
    <a onclick="changeurl('jadwal.php?page=tambah');" id="tambah" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Jadwal</a>
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
    <div class="col-sm-6"></div>
    <div class="col-sm-2">
      <div class="form-group">
        <select class="form-control form-control-sm" id="kelas">
          <optgroup label="Pilih Kelas">
            <option value="all">All Kelas</option>
            <?php
            require_once __DIR__.'/../../../app/config.php';
            foreach ($db->table('kelas')->orderBy('nama_kelas')->get() as $key => $row) {?>
              <option value="<?= $row->kode_kelas; ?>"><?= $row->nama_kelas; ?></option>
            <?php } ?>
          </optgroup>
        </select>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <select class="form-control form-control-sm" id="mapel">
          <optgroup label="Pilih Mapel">
            <option value="all">All Mapel</option>
            <?php
            foreach ($db->table('mapel')->orderBy('nama_mapel')->get() as $key => $row) {?>
              <option value="<?= $row->id_mapel; ?>"><?= $row->nama_mapel; ?></option>
            <?php } ?>
          </optgroup>
        </select>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="datatables">
      <thead>
        <tr>
          <th rowspan="2">#</th>
          <th rowspan="2" class="col-th-5">Nama</th>
          <th rowspan="2" class="col-th-5">Keterangan</th>
          <th rowspan="2" class="col-th-3">Mapel</th>
          <th rowspan="2" class="col-th-1">Kelas</th>
          <th rowspan="2" class="col-th-4">Waktu Mulai</th>
          <th rowspan="2" class="col-th-4">Waktu Selesai</th>
          <th rowspan="2" class="col-th-1">Durasi</th>
          <th rowspan="2" class="col-th-1">Status</th>
          <th colspan="3" class="text-center">Tampilkan Laporan</th>
          <th rowspan="2" id="table-th-4">Aksi</th>
        </tr>
        <tr>
          <th id="table-th-1">Nilai Tercapai</th>
          <th id="table-th-2">Laporan Hasil</th>
          <th id="table-th-2">Dapat Diulang</th>
        </tr>
      </thead>
      <tbody id="tampiljadwal">

      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#tambah').click( function() {
        $('#tampil').load('resource/views/jadwal/_add.php', {page: '<?= token(32); ?>'});
      });

      $('#reload').click( function() {
        $('#tampil').load('resource/views/jadwal/_show.php', {page: '<?= token(32); ?>'});
        changeurl('jadwal.php');
      });
      $('#tampiljadwal').load('resource/views/jadwal/inc/_jadwal.php', {
        kelas: $('#kelas').val(),
        mapel: $('#mapel').val()
      });

      $('#lenghtRows').change( function() {
        $('#tampiljadwal').load('resource/views/jadwal/inc/_jadwal.php', {
          rows: $(this).val(),
          kelas: $('#kelas').find(":selected").val(),
          mapel: $('#mapel').val(),
          search: $('#search').val(),
        });
      }); // end Rows
      $('#kelas').change( function() {
        $('#tampiljadwal').load('resource/views/jadwal/inc/_jadwal.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          kelas: $(this).val(),
          mapel: $('#mapel').val(),
          search: $('#search').val()
        });
      });
      $('#mapel').change( function() {
        $('#tampiljadwal').load('resource/views/jadwal/inc/_jadwal.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          kelas: $('#kelas').val(),
          mapel: $(this).val(),
          search: $('#search').val()
        });
      });
      /**
      * Data Download
      */
      $('#excel').click( function() {
        $('#datatables').table2excel({
          filename: 'Laporan Data Jadwal'
        });
      });
    });
  </script>
<?php endif; ?>
