<!-- Side Navbar -->
<nav class="side-navbar ujianlangsung">
  <div class="side-navbar-wrapper">
    <!-- Sidebar Header    -->
    <div class="sidenav-header d-flex align-items-center justify-content-center">
      <!-- User Info-->
      <div id="userinfo"></div>
      <!-- Small Brand information, appears on minimized sidebar-->
      <div class="sidenav-header-logo"><a onclick="changeurl('index.php');" class="menuhome brand-small text-center"> <strong>S</strong><strong class="text-primary">H</strong></a></div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <?php
      if (isset($_SESSION['role_siswa'])) {
        require_once 'sidebar/siswa.php';
      } elseif (isset($_SESSION['role_petugas'])) {
        $s = $_SESSION['role_petugas'];
        if ($s == 1) {
          require_once 'sidebar/administrator.php';
        }elseif ($s == 2) {
          require_once 'sidebar/staf.php';
        }elseif ($s == 3) {
          require_once 'sidebar/guru.php';
        }else {
          require_once 'sidebar/proktor.php';
        }
      }
    ?>
    <script type="text/javascript">
      $(document).ready( function() {
        <?php if (isset($_SESSION['role_siswa'])) {
          require_once 'scriptJs/siswa.php';
        } elseif (isset($_SESSION['role_petugas'])) {
          $s = $_SESSION['role_petugas'];
          if ($s == 1) {
            require_once 'scriptJs/administrator.php';
          }elseif ($s == 2) {
            require_once 'scriptJs/staf.php';
          }elseif ($s == 3) {
            require_once 'scriptJs/guru.php';
          }else {
            require_once 'scriptJs/proktor.php';
          }
        } ?>
      });
    </script>
  </div>
</nav>
<!-- End Side Navbar -->
<script type="text/javascript">
  $('#userinfo').load('resource/template/userinfo.php');
</script>
