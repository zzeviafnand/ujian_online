$('#menujadwal').click( function() {
  $('#menupage').load('resource/views/jadwal/siswa/_home.php');
  $('.menuActive').removeClass('active');
  $('.pageRemove').remove();
  $('#Acjadwal').addClass('active');
  changeurl('jadwal.php');
});
