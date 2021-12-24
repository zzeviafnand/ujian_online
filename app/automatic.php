<?php
$startYear = date('Y');
$startMonth = date('m');
$endYear = $startYear+1;

/**
 * @return automaticAjaran
 */
$startAjaran = 'TA'.substr($startYear, 2).substr($endYear, 2);
$endAjaran = $startYear.'/'.$endYear;
if ($db->table('tahunajaran')->select('nama_tahunajaran')->where('kode_tahunajaran', $startAjaran)->get() == 0) {
  $db->table('tahunajaran')->insert(['kode_tahunajaran' => $startAjaran, 'nama_tahunajaran' => $endAjaran]);
}

/**
 * @return automaticSemester
 */
function autoSemester($int, $ajaran) {
  global $startYear, $endYear, $db;
  for ($i=0; $i < count($int); $i++) {
    $startSemester = 'TAS'.substr($startYear, 2).substr($endYear, 2).$int[$i];
    if ($db->table('semester')->where('kode_semester', $startSemester)->get() == 0) {
      $db->table('semester')->insert(['kode_semester' => $startSemester, 'kategori_semester' => $int[$i], 'kode_tahunajaran' => $ajaran]);
    }
  }
}
if ($startMonth == 1 && $startMonth == 2 && $startMonth == 3 && $startMonth == 4 && $startMonth == 5 && $startMonth == 6) {
  autoSemester([2, 4, 6], $startAjaran);
}else {
  autoSemester([1, 3, 5], $startAjaran);
}
