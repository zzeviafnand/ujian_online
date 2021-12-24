<?php if (isset($_POST['page'])): ?>
  <div class="mb-4">
    <div class="btn-group float-right" role="group">
      <button id="download" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-download"></span> Download
      </button>
      <div class="dropdown-menu" aria-labelledby="download">
        <button onclick="changeurl('nilai.php?nilai=download&id=print');" id="print" type="button" class="dropdown-item btn-light"><span class="fa fa-print"></span> Print</button>
        <button onclick="changeurl('nilai.php?nilai=download&id=pdf');" id="pdf" type="button" class="dropdown-item btn-light"><span class="fa fa-file-pdf"></span> PDF</button>
        <button onclick="changeurl('nilai.php?nilai=download&id=xls');" id="excel" type="button" class="dropdown-item btn-light"><span class="fa fa-file-excel"></span> XLS</button>
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
        <select class="form-control form-control-sm" id="mapel">
          <optgroup label="Pilih Mapel">
            <option value="all">All Mapel</option>
            <?php
            require_once __DIR__.'/../../../../app/config.php';
            $fields = [
              'kelas' => 'kelas.kode_kelas = jadwal.kode_kelas',
              'jadwal' => 'kbm.id_kbm = jadwal.id_kbm',
              'kbm' => 'kbm.id_mapel = mapel.id_mapel',
            ];
            $posts = $db->table('mapel')->selfJoin($fields)->where('kelas.register_petugas', $_SESSION['user_petugas'])->get();
            if (is_array($posts)) {
              foreach ($db->table('mapel')->selfJoin($fields)->where('kelas.register_petugas', $_SESSION['user_petugas'])->get() as $key => $row) {?>
                <option value="<?= $row->id_mapel; ?>"><?= $row->nama_mapel; ?></option>
              <?php }} ?>
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
          <th class="col-th-3">Nama Siswa</th>
          <th class="col-th-4">Mapel</th>
          <th>KKM</th>
          <th>Nilai</th>
        </tr>
      </thead>
      <tbody id="tampilnilai">
      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    $(document).ready( function() {
      $('#tampilpage').text('Siswa');
      $('#Acnilaisiswa').addClass('active');

      $('#reload').click( function() {
        $('#tampil').load('resource/views/nilai/guru/_siswa.php', {page: '<?= token(32); ?>'});
        changeurl('nilai.php');
      });
      $('#tampilnilai').load('resource/views/nilai/guru/inc/_siswa.php', {
        mapel: $('#mapel').val(),
        search: $('#search').val()
      });

      $('#lenghtRows').change( function() {
        $('#tampilnilai').load('resource/views/nilai/guru/inc/_siswa.php', {
          rows: $(this).val(),
          mapel: $('#mapel').find(":selected").val(),
          search: $('#search').val(),
        });
      }); // end Rows
      $('#mapel').change( function() {
        $('#tampilnilai').load('resource/views/nilai/guru/inc/_siswa.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          mapel: $(this).val(),
          search: $('#search').val()
        });
      });
      $('#search').on('keyup', function() {
        var search = $(this).val();
        if (search == '') {
          changeurl('nilai.php');
        } else {
          changeurl('nilai.php?siswa=search&name='+search);
        }
        $('#tampilnilai').load('resource/views/nilai/guru/inc/_siswa.php', {
          rows: $('#lenghtRows').find(":selected").val(),
          mapel: $('#mapel').val(),
          search: search
        });
      });
      /**
      * Data Download
      */
      $('#excel').click( function() {
        $('#datatables').table2excel({
          filename: 'Laporan Data Nilai Siswa'
        });
      });
    });
  </script>
<?php endif; ?>
