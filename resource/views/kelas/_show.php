<?php if (isset($_POST['page'])): ?>
  <div class="mb-4">
    <div class="btn-group float-right" role="group">
      <button id="download" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-download"></span> Download
      </button>
      <div class="dropdown-menu" aria-labelledby="download">
        <button onclick="changeurl('kelas.php?kelas=download&id=print');" id="print" type="button" class="dropdown-item btn-light"><span class="fa fa-print"></span> Print</button>
        <button onclick="changeurl('kelas.php?kelas=download&id=pdf');" id="pdf" type="button" class="dropdown-item btn-light"><span class="fa fa-file-pdf"></span> PDF</button>
        <button onclick="changeurl('kelas.php?kelas=download&id=xls');" id="excel" type="button" class="dropdown-item btn-light"><span class="fa fa-file-excel"></span> XLS</button>
      </div>
    </div>
    <a onclick="changeurl('kelas.php?page=tambah');" id="tambah" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Kelas</a>
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
    <div class="col-sm-3"></div>
    <div class="col-sm-2">
      <div class="form-group">
        <select class="form-control form-control-sm" id="jurusan">
          <optgroup label="Pilih Jurusan">
            <option value="all">All Jurusan</option>
            <?php
            require_once __DIR__.'/../../../app/config.php';
            foreach ($db->table('jurusan')->orderBy('nama_jurusan')->get() as $key => $row) {?>
              <option value="<?= $row->kode_jurusan; ?>"><?= $row->nama_jurusan; ?></option>
            <?php } ?>
          </optgroup>
        </select>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <select class="form-control form-control-sm" id="tahunajaran">
          <optgroup label="Pilih Tahun Ajaran">
            <option value="all">All Tahun Ajaran</option>
            <?php
            foreach ($db->table('tahunajaran')->orderBy('nama_tahunajaran')->get() as $key => $row) {?>
              <option value="<?= $row->kode_tahunajaran; ?>"><?= $row->nama_tahunajaran; ?></option>
            <?php } ?>
          </optgroup>
        </select>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <input type="text" id="search" class="form-control form-control-sm" placeholder="Search wali kelas...">
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover" id="datatables">
      <thead>
        <tr>
          <th>#</th>
          <th class="col-th-3">Kode Kelas</th>
          <th class="col-th-2">Kelas</th>
          <th class="col-th-3">Wali Kelas</th>
          <th class="col-th-3">Tahun Ajaran</th>
          <th class="col-th-4">Jurusan</th>
          <th id="table-th-3">Aksi</th>
        </tr>
      </thead>
      <tbody id="tampilkelas">
      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#tambah').click( function() {
        $('#tampil').load('resource/views/kelas/_add.php', {page: '<?= token(32); ?>'});
      });

      $('#reload').click( function() {
        $('#tampil').load('resource/views/kelas/_show.php', {page: '<?= token(32); ?>'});
        changeurl('kelas.php');
      });
      $('#tampilkelas').load('resource/views/kelas/inc/_kelas.php', {
        jurusan: $('#jurusan').val(),
        tahunajaran: $('#tahunajaran').val()
      });

      $('#lenghtRows').change( function() {
        $('#tampilkelas').load('resource/views/kelas/inc/_kelas.php', {
          rows: $(this).val(),
          jurusan: $('#jurusan').find(":selected").val(),
          tahunajaran: $('#tahunajaran').val(),
          search: $('#search').val(),
        });
      }); // end Rows
      $('#jurusan').change( function() {
        $('#tampilkelas').load('resource/views/kelas/inc/_kelas.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          jurusan: $(this).val(),
          tahunajaran: $('#tahunajaran').val(),
          search: $('#search').val()
        });
      });
      $('#tahunajaran').change( function() {
        $('#tampilkelas').load('resource/views/kelas/inc/_kelas.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          jurusan: $('#jurusan').val(),
          tahunajaran: $(this).val(),
          search: $('#search').val()
        });
      });
      $('#search').on('keyup', function() {
        var search = $(this).val();
        if (search == '') {
          changeurl('kelas.php');
        } else {
          changeurl('kelas.php?siswa=search&name='+search);
        }
        $('#tampilkelas').load('resource/views/kelas/inc/_kelas.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          jurusan: $('#jurusan').val(),
          tahunajaran: $('#tahunajaran').val(),
          search: search
        });
      });
      /**
      * Data Download
      */
      $('#excel').click( function() {
        $('#datatables').table2excel({
          filename: 'Laporan Data Kelas'
        });
      });
    });
  </script>
<?php endif; ?>
