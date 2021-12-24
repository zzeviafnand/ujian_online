<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <title>Login - SMK HASANAH</title>
    <script src="public/js/jquery-3.3.1.min.js" charset="utf-8"></script>
    <?php require 'resource/template/style.php';?>
  </head>
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <?php

            ob_start();
            session_start();
            require_once 'vendor/autoload.php';
            require_once 'app/validation.php';
            $msg = new Plasticbrain\FlashMessages\FlashMessages();
            $db = new Basemodel\QueryBuilder\DB();

            if (Input::get('login')) {
              if ($db->table('petugas')->select('register_petugas')->where('register_petugas', $_POST['username'])->get() != 0) {
                foreach ($db->table('petugas')->select('password_petugas, level_petugas')->where('register_petugas', $_POST['username'])->get() as $key => $value);
                if (password_verify(Input::get('password'), $value->password_petugas)) {
                  $_SESSION['role_petugas'] = $value->level_petugas;
                  $_SESSION['user_petugas'] = Input::get('username');
                  header('Location:index.php');
                } else {
                  $msg->info('Password yang Anda masukan salah');
                }
              } elseif ($db->table('siswa')->select('username')->where('username', $_POST['username'])->get() != 0) {
                foreach ($db->table('siswa')->select('password')->where('username', $_POST['username'])->get() as $key => $value);
                if (password_verify(Input::get('password'), $value->password)) {
                  $_SESSION['role_siswa'] = Input::get('username');
                  header('Location:index.php');
                } else {
                  $msg->info('Password yang Anda masukan salah');
                }
              }else {
                $msg->info('Maaf!, username yang Anda masukan belum terdaftar');
              }
            }else {
              if (isset($_SESSION['role_petugas']) || isset($_SESSION['role_siswa'])) {
                header('Location:index.php');
              }
            }
            ?>
            <?php $msg->display(); ?>
            <div class="logo text-uppercase"><span>Ujian Online</span><br><strong class="text-primary">SMK HASANAH</strong></div>
            <p>Agar kamu mendapatkan jalan yang benar, maka saling tolong menolonglah kamu. Saudaramu mendapatkan sebuah ujian maka kau tolonglah ia.</p>
            <form method="POST" class="text-left form-validate">
              <div class="form-group-material">
                <input id="login-username" type="text" name="username" required data-msg="Please enter your username" class="input-material">
                <label for="login-username" class="label-material">Username</label>
              </div>
              <div class="form-group-material">
                <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                <label for="login-password" class="label-material">Password</label>
              </div>
              <div class="form-group text-center">
                <input type="submit" name="login" value="Login" class="btn btn-primary">
              </div>
            </form>
          </div>
          <div class="copyrights text-center">
            <!-- <p>Powered by <a href="https://smkhasanah.sch.id" target="_blank" class="external">SMK HASANAH</a></p> -->
            <p>Software by <a href="https://www.sekolahprogram.com" target="_blank" class="external">Sekolah Program</a></p>
          </div>
        </div>
      </div>
    </div>
    <?php require 'resource/template/script.php'; ?>
    <script src="public/js/jquery.validate.min.js"></script>
    <script>
      window.setTimeout(function() {
        $("div.alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
      }, 3000);
    </script>
  </body>
</html>
