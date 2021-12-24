$('#menutahunajaran').click( function() {
  $('#menupage').load('resource/views/tahunajaran/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Actahunajaran').addClass('active');
  changeurl('tahunajaran.php');
});
$('#menusemester').click( function() {
  $('#menupage').load('resource/views/semester/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Acsemester').addClass('active');
  changeurl('semester.php');
});
$('#menujurusan').click( function() {
  $('#menupage').load('resource/views/jurusan/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Acjurusan').addClass('active');
  changeurl('jurusan.php');
});
$('#menukelas').click( function() {
  $('#menupage').load('resource/views/kelas/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Ackelas').addClass('active');
  changeurl('kelas.php');
});
$('#menuguru').click( function() {
  $('#menupage').load('resource/views/guru/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Acguru').addClass('active');
  changeurl('guru.php');
});
$('#menukbm').click( function() {
  $('#menupage').load('resource/views/kbm/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Ackbm').addClass('active');
  changeurl('kbm.php');
});
$('#menusiswa').click( function() {
  $('#menupage').load('resource/views/siswa/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Acsiswa').addClass('active');
  changeurl('siswa.php');
});
$('#menumapel').click( function() {
  $('#menupage').load('resource/views/mapel/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Acmapel').addClass('active');
  changeurl('mapel.php');
});
$('#menusoal').click( function() {
  $('#menupage').load('resource/views/soal/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Acsoal').addClass('active');
  changeurl('soal.php');
});
$('#menujadwal').click( function() {
  $('#menupage').load('resource/views/jadwal/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Acjadwal').addClass('active');
  changeurl('jadwal.php');
});
$('#menunilai').click( function() {
  $('#menupage').load('resource/views/nilai/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Acnilai').addClass('active');
  changeurl('nilai.php');
});
$('#menupetugas').click( function() {
  $('#menupage').load('resource/views/petugas/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Acpetugas').addClass('active');
  changeurl('petugas.php');
});
