<?php
/* Session ve OB Değerlerini Açtık */
session_start(); ob_start();
/* Gerekli Dosyları Çağırdık */
require_once 'database.php';
require_once 'functions/encrypt.php';
?>
<?php
if($_SESSION['giris']){
    header ("Location:index.php");
} else {
?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kullanıcı Girişi Yapılan Sayfa">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Forum Giriş Sayfası</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>



<?php
    $kullanici_giris=strip_tags(mysqli_real_escape_string($db,trim($_GET['kullanici_giris'])));
    $sifre_giris=strip_tags(mysqli_real_escape_string($db,trim($_GET['sifre_giris'])));

    $_SESSION['giris'] = false;
    /* Formdan Veri Gelmiş Mi Diye Kontrol Ettik */
    if(isset($_GET['kullanici_giris']) && isset($_GET['sifre_giris'])) {
        $sql = mysqli_query($db,"SELECT * FROM uyeler WHERE kullanici_adi='$kullanici_giris'");
        if($sql) {
            $kullanici_sql =  mysqli_fetch_array($sql,MYSQLI_ASSOC);
                if($kullanici_sql){
                    $kontrol_sifre = $kullanici_sql['sifre'];
                    $sifre_giris = sifrele($sifre_giris);
                    if($sifre_giris == $kontrol_sifre) {
                        echo '<div class="container theme-showcase" role="main">
                            <div class="alert alert-success">
                                <strong>Tebrikler !</strong> Sistemimize Başarıyla Giriş Yaptınız .
                              </div>
                              </div>';
                        $_SESSION['giris'] = true;
                        $_SESSION['kullanici']=$kullanici_sql['kullanici_adi'];
                        $_SESSION['kullanici_id']=$kullanici_sql['id'];
                        $_SESSION['kullanici_mail']=$kullanici_sql['mail'];
                        $_SESSION['kullanici_rutbe']=$kullanici_sql['rutbe'];
                        echo '<meta http-equiv="refresh" content="1;URL=index.php">';
						die;
                    } else {
                        echo '<div class="container theme-showcase" role="main">
                            <div class="alert alert-danger">
                                <strong>Hata !</strong> Karşılaştırma Yapılamadı .
                              </div>
                              </div>';
                    }
                } else {
                    echo '<div class="container theme-showcase" role="main">
                            <div class="alert alert-danger">
                                <strong>Hata !</strong> Kullanıcı Adı veya Şifre Yanlış .
                              </div>
                              </div>';
                }
        } else {
            echo '<div class="container theme-showcase" role="main">
                            <div class="alert alert-danger">
                                <strong>Hata !</strong> Sorgulama Yapılamadı .
                              </div>
                              </div>';
        }
    }
?>


  <body>

    <div class="container">

      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">Lütfen Giriş Yapın</h2>
        <input name="kullanici_giris" type="text" class="form-control" placeholder="Kullanici Adi" required autofocus>
        <input name="sifre_giris" type="password" class="form-control" placeholder="Şifre" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Beni Hatırla
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş Yap</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
<?php
}
?>
