<section class="dashboard-counts section-padding">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-5">
        <div class="card">
          <div class="card-header">
            <h4>Profile Kamu</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                  <?php
                  $posts = $db->table('siswa')->where('nis_siswa', $_SESSION['role_siswa'])->get();
                  if (is_array($posts)) {
                    foreach ($posts as $key => $row) {?>
                    <tr>
                      <th>NIS</th>
                      <td><?= $row->nis_siswa; ?></td>
                    </tr>
                    <tr>
                      <th>Nama Lengkap</th>
                      <td><?= $row->nama_siswa; ?></td>
                    </tr>
                    <tr>
                      <th>Tempat Lahir</th>
                      <td><?= $row->tempat_siswa; ?></td>
                    </tr>
                    <tr>
                      <th>Kelamin</th>
                      <td><?= gender($row->kelamin_siswa); ?></td>
                    </tr>
                  <?php }} ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="card">
          <div class="card-header">
            <h4>Syarat Test Ujian</h4>
          </div>
          <div class="card-body">
            <article class="text-justify">
              <p>Syarat siswa melakukan ujian</p>
              <ol>
                <li>Memiliki kartu ujian</li>
                <li>Memiliki kartu ujian</li>
                <li>Memiliki kartu ujian</li>
                <li>Memiliki kartu ujian</li>
                <li>Memiliki kartu ujian</li>
                <li>Memiliki kartu ujian</li>
              </ol>
            </article>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
