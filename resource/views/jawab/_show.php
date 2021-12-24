<?php if (isset($_POST['page'])): ?>
  <div class="mb-4">
    <div class="btn-group float-right" role="group">
      <button id="download" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-download"></span> Download
      </button>
      <div class="dropdown-menu" aria-labelledby="download">
        <button onclick="changeurl('jawab.php?jawab=download&id=print');" id="print" type="button" class="dropdown-item btn-light"><span class="fa fa-print"></span> Print</button>
        <button onclick="changeurl('jawab.php?jawab=download&id=pdf');" id="pdf" type="button" class="dropdown-item btn-light"><span class="fa fa-file-pdf"></span> PDF</button>
        <button onclick="changeurl('jawab.php?jawab=download&id=xls');" id="excel" type="button" class="dropdown-item btn-light"><span class="fa fa-file-excel"></span> XLS</button>
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
    <div class="col-sm-5"></div>
    <div class="col-sm-2">
      <div class="form-group">
        <select class="form-control form-control-sm" id="kelas">
          <optgroup label="Pilih Kelas">
            <option value="all">All Kelas</option>
            <?php
            require_once __DIR__.'/../../../app/config.php';
            $fields = [
              'jadwal' => 'kelas.kode_kelas = jadwal.kode_kelas',
              'kbm' => 'kbm.id_kbm = jadwal.id_kbm',
              'petugas' => 'petugas.register_petugas = kbm.register_petugas',
            ];
            $posts = $db->table('kelas')->selfJoin($fields)->where('petugas.register_petugas', $_SESSION['user_petugas'])->orderBy('nama_kelas', 'ASC')->get();
            foreach ($posts as $key => $row) {?>
              <option value="<?= $row->kode_kelas; ?>"><?= $row->nama_kelas; ?></option>
            <?php } ?>
          </optgroup>
        </select>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <input type="text" id="search" class="form-control form-control-sm" placeholder="Search siswa...">
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>NIS</th>
          <th class="col-th-4">Nama Siswa</th>
          <th>Kelas</th>
          <th id="table-th-3">Aksi</th>
        </tr>
      </thead>
      <tbody id="tampiljawab">
      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#reload').click( function() {
        $('#tampil').load('resource/views/jawab/_show.php', {page: '<?= token(32); ?>'});
        changeurl('jawab.php');
      });
      $('#tampiljawab').load('resource/views/jawab/inc/_jawab.php', {
        kelas: $('#kelas').val(),
        search: $('#search').val()
      });

      $('#lenghtRows').change( function() {
        $('#tampiljawab').load('resource/views/jawab/inc/_jawab.php', {
          rows: $(this).val(),
          kelas: $('#kelas').find(":selected").val(),
          search: $('#search').val(),
        });
      }); // end Rows
      $('#kelas').change( function() {
        $('#tampiljawab').load('resource/views/jawab/inc/_jawab.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          kelas: $(this).val(),
          search: $('#search').val()
        });
      });
      $('#search').on('keyup', function() {
        var search = $(this).val();
        if (search == '') {
          changeurl('jawab.php');
        } else {
          changeurl('jawab.php?siswa=search&name='+search);
        }
        $('#tampiljawab').load('resource/views/jawab/inc/_jawab.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          kelas: $('#kelas').val(),
          search: search
        });
      });
      /**
      * Data Download
      */
      $('#excel').click( function() {
        $('#datatables').table2excel({
          filename: 'Laporan Data Jawaban Siswa'
        });
      });
    });
  </script>
<?php endif; ?>
