$('#menusiswa').click( function() {
  $('#menupage').load('resource/views/siswa/proktor/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('.pageRemove').remove();
  $('#Acsiswa').addClass('active');
  changeurl('siswa.php');
});
$('#menujadwal').click( function() {
  $('#menupage').load('resource/views/jadwal/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('#Acjadwal').addClass('active');
  changeurl('jadwal.php');
});
