<?php
if (isset($_POST['waktu']) && isset($_COOKIE['jadwal'])) {
  if ($_POST['waktu'] != '') {
    require_once __DIR__.'/../../../../../app/config.php';
    foreach ($db->table('siswa')->select('pengaturan_siswa')->where('nis_siswa', $_SESSION['role_siswa'])->get() as $key => $value);
    $setting = explode(':', $value->pengaturan_siswa);
    $waktu = explode(':', $_POST['waktu']);
    $settings = [
      4 => (is_null($setting[4])) ? 0 : $setting[4],
      5 => (is_null($setting[5])) ? 0 : $setting[5]
    ];
    if (!is_null($setting[4]) || !is_null($setting[5])) {
      $db->table('siswa')->where('nis_siswa', $_SESSION['role_siswa'])->update(['pengaturan_siswa' => $waktu[0].':'.$waktu[1].':'.$waktu[2].':'.decode($_COOKIE['jadwal']).':'.$settings[4].':'.$settings[5]]);
      $waktu = ($waktu[0]*60*60) + ($waktu[1]*60) + $waktu[2];
      // time+3jam
      setCookie('waktu', encode($waktu), time()+10800, '/');
    }
  }
}
