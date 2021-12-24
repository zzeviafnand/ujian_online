<?php if (isset($_POST['page'])): ?>
  <div class="mb-4">
    <div class="btn-group float-right" role="group">
      <button id="download" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-download"></span> Download
      </button>
      <div class="dropdown-menu" aria-labelledby="download">
        <button onclick="changeurl('kbm.php?kbm=download&id=print');" id="print" type="button" class="dropdown-item btn-light"><span class="fa fa-print"></span> Print</button>
        <button onclick="changeurl('kbm.php?kbm=download&id=pdf');" id="pdf" type="button" class="dropdown-item btn-light"><span class="fa fa-file-pdf"></span> PDF</button>
        <button onclick="changeurl('kbm.php?kbm=download&id=xls');" id="excel" type="button" class="dropdown-item btn-light"><span class="fa fa-file-excel"></span> XLS</button>
      </div>
    </div>
    <a onclick="changeurl('kbm.php?page=tambah');" id="tambah" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add KBM</a>
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
        <select class="form-control form-control-sm" id="tahunajaran">
          <optgroup label="Pilih Tahun Ajaran">
            <option value="all">All Tahun Ajaran</option>
            <?php
            require_once __DIR__.'/../../../app/config.php';
            foreach ($db->table('tahunajaran')->orderBy('nama_tahunajaran')->get() as $key => $row) {?>
              <option value="<?= $row->kode_tahunajaran; ?>"><?= $row->nama_tahunajaran; ?></option>
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
          <th class="col-th-3">Tahun Ajaran</th>
          <th class="col-th-1">Semester</th>
          <th class="col-th-4">Mapel</th>
          <th class="col-th-3">Guru</th>
          <th id="table-th-3">Aksi</th>
        </tr>
      </thead>
      <tbody id="tampilkbm">
      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#tambah').click( function() {
        $('#tampil').load('resource/views/kbm/_add.php', {page: '<?= token(32); ?>'});
      });

      $('#reload').click( function() {
        $('#tampil').load('resource/views/kbm/_show.php', {page: '<?= token(32); ?>'});
        changeurl('kbm.php');
      });
      $('#tampilkbm').load('resource/views/kbm/inc/_kbm.php', {
        tahunajaran: $('#tahunajaran').val(),
        mapel: $('#mapel').val()
      });

      $('#lenghtRows').change( function() {
        $('#tampilkbm').load('resource/views/kbm/inc/_kbm.php', {
          rows: $(this).val(),
          tahunajaran: $('#tahunajaran').find(":selected").val(),
          mapel: $('#mapel').val(),
          search: $('#search').val(),
        });
      }); // end Rows
      $('#tahunajaran').change( function() {
        $('#tampilkbm').load('resource/views/kbm/inc/_kbm.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          tahunajaran: $(this).val(),
          mapel: $('#mapel').val(),
          search: $('#search').val()
        });
      });
      $('#mapel').change( function() {
        $('#tampilkbm').load('resource/views/kbm/inc/_kbm.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          tahunajaran: $('#tahunajaran').val(),
          mapel: $(this).val(),
          search: $('#search').val()
        });
      });
      $('#search').on('keyup', function() {
        var search = $(this).val();
        if (search == '') {
          changeurl('kbm.php');
        } else {
          changeurl('kbm.php?siswa=search&name='+search);
        }
        $('#tampilkbm').load('resource/views/kbm/inc/_kbm.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          tahunajaran: $('#tahunajaran').val(),
          mapel: $('#mapel').val(),
          search: search
        });
      });
      /**
      * Data Download
      */
      $('#excel').click( function() {
        $('#datatables').table2excel({
          filename: 'Laporan Data KBM'
        });
      });
    });
  </script>
<?php endif; ?>
