<script type="text/javascript">
  $(document).ready( function() {
    $('.menuhome').click( function() {
      $('#menupage').load('resource/views/dashboard/_home.php');
      $('.menuActive').removeClass('active');
      $('.pageRemove').remove();
      $('#Achome').addClass('active');
      changeurl('index.php');
    });
  });
</script>
