<?php if (isset($_POST['page'])): ?>
  <?php require_once __DIR__.'/../../../app/config.php';?>
  <div class="mb-4">
    <div class="btn-group float-right" role="group">
      <button id="download" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-download"></span> Download
      </button>
      <div class="dropdown-menu" aria-labelledby="download">
        <button onclick="changeurl('siswa.php?siswa=download&id=print');" id="print" type="button" class="dropdown-item btn-light"><span class="fa fa-print"></span> Print</button>
        <button onclick="changeurl('siswa.php?siswa=download&id=pdf');" id="pdf" type="button" class="dropdown-item btn-light"><span class="fa fa-file-pdf"></span> PDF</button>
        <button onclick="changeurl('siswa.php?siswa=download&id=xls');" id="excel" type="button" class="dropdown-item btn-light"><span class="fa fa-file-excel"></span> XLS</button>
      </div>
    </div>
    <a onclick="changeurl('siswa.php?siswa=tambah');" id="tambah" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Siswa</a>
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
    <div class="col-md-5"></div>
    <div class="col-md-2">
      <div class="form-group">
        <select class="form-control form-control-sm " name="kelas" id="kelas" required>
          <optgroup label="Pilih Kelas">
            <option value="all">All Kelas</option>
            <?php foreach($db->table('kelas')->orderBy('nama_kelas', 'ASC')->get() as $key => $row){ ?>
              <option value="<?= $row->kode_kelas; ?>"><?= $row->nama_kelas; ?></option>
            <?php } ?>
          </optgroup>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <input type="text" id="search" class="form-control form-control-sm" placeholder="Search siswa...">
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover" id="datatables">
      <thead>
        <tr>
          <th>NIS</th>
          <th class="col-th-4">Siswa</th>
          <th class="col-th-5">Tempat/Tanggal Lahir</th>
          <th class="col-th-2">JK</th>
          <th class="col-th-2">kelas</th>
          <th class="col-th-2">Telepon</th>
          <th class="col-th-2">Username</th>
          <th id="table-th-3">Aksi</th>
        </tr>
      </thead>
      <tbody id="tampilsiswa">

      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#tampilsiswa').load('resource/views/siswa/inc/_siswa.php', {
        rows: $('#lenghtRows').find(":selected").val(),
        kelas: $('#kelas').find(":selected").val(),
        search: $('#search').val(),
      });
      $('#tambah').click( function() {
        $('#tampil').load('resource/views/siswa/_add.php', {page: '<?= token(32); ?>'});
      });
      $('#reload').click( function() {
        $('#tampil').load('resource/views/siswa/_show.php', {page: '<?= token(32); ?>'});
        changeurl('siswa.php');
      });
      $('#lenghtRows').change( function() {
        $('#tampilsiswa').load('resource/views/siswa/inc/_siswa.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          kelas: $('#kelas').find(":selected").val(),
          search: $('#search').val(),
        });
      }); // end Rows
      $('#kelas').change(function(){
        $('#tampilsiswa').load('resource/views/siswa/inc/_siswa.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          kelas: $('#kelas').find(":selected").val(),
          search: $('#search').val(),
        });
      }); // end kelas
      $('#search').on('keyup', function() {
        var search = $('#search').val();
        if (search == '') {
          changeurl('siswa.php');
        } else {
          changeurl('siswa.php?siswa=search&name='+search);
        }
        $('#tampilsiswa').load('resource/views/siswa/inc/_siswa.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          kelas: $('#kelas').find(":selected").val(),
          search: search,
        });
      }); // end search
      /**
      * Data Download
      */
      $('#excel').click( function() {
        $('#datatables').table2excel({
          filename: 'Laporan Data Siswa'
        });
      });
    }); // end redy

  </script>
  <!-- <script src="public/js/jspdf.min.js" charset="utf-8"></script> -->
<?php endif; ?>
