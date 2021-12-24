<?php
require_once __DIR__.'/../../../app/config.php';
$msg->display();
?>
<script>
  window.setTimeout(function() {
    $("div.alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
  }, 3000);
</script>