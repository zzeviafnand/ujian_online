$('#menusoal').click( function() {
  $('#menupage').load('resource/views/soal/guru/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('.pageRemove').remove();
  $('#Acsoal').addClass('active');
  changeurl('soal.php');
  $('.down a').attr('aria-expanded', 'false');
  $('#nilaiDropdown').removeClass('show');
});
$('#menujawab').click( function() {
  $('#menupage').load('resource/views/jawab/_home.php', {
    page: '<?= token(32); ?>',
  });
  $('.menuActive').removeClass('active');
  $('.pageRemove').remove();
  $('#Acjawab').addClass('active');
  changeurl('jawab.php');
  $('.down a').attr('aria-expanded', 'false');
  $('#nilaiDropdown').removeClass('show');
});
$('#menunilaisiswa').click( function() {
  $('#menupage').load('resource/views/nilai/guru/_home.php?page=siswa', {
    page: 'HbXt21GlihpZw4imc2lqxIuSg80EVSfK467zd2EOrxnxm4I8Tpy1Ezg',
  });
  $('.menuActive').removeClass('active');
  $('.pageRemove').remove();
  $('#Acnilaisiswa').addClass('active');
  changeurl('nilai.php?page=siswa');
});
$('#menunilaipengajar').click( function() {
  $('#menupage').load('resource/views/nilai/guru/_home.php?page=pengajar', {
    page: 'mQTkcZpyKc45yOdrcGVuZgkzr44u7DK5InS0R2FqYXIlsMYJ4RIPCWFckkw',
  });
  $('.menuActive').removeClass('active');
  $('.pageRemove').remove();
  $('#Acnilaipengajar').addClass('active');
  changeurl('nilai.php?page=pengajar');
});
