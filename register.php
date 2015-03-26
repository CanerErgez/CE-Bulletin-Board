<?php
/* Session ve OB Değerlerini Başlattık */
session_start(); ob_start();
/* Gerekli Dosyaları Çağırdık */
require_once 'database.php';
require_once 'functions/encrypt.php';
require_once 'functions/site.php';
?>
<?php
if($_SESSION['giris']){
    header ("Location:index.php");
} else {
?>
<?php
/* Formdan Veri Gelmiş Mi Diye Kontrol Ettik */
if(isset($_GET['kullanici_adi']) && isset($_GET['sifre']) && isset($_GET['sifre_kontrol']) && isset($_GET['mail'])) {
    $kullanici_adi=strip_tags(mysqli_real_escape_string($db,trim($_GET['kullanici_adi'])));
    $sifre=strip_tags(mysqli_real_escape_string($db,trim($_GET['sifre'])));
    $sifre_kontrol=strip_tags(mysqli_real_escape_string($db,trim($_GET['sifre_kontrol'])));
    $mail=strip_tags(mysqli_real_escape_string($db,trim($_GET['mail'])));

    /* Kullanıcı Adı ve Mail Var Mı Sorgusu */
    $kontrol_kadi=  mysqli_query($db,"SELECT * FROM uyeler WHERE kullanici_adi='$kullanici_adi'");
    $kontrol_mail=  mysqli_query($db,"SELECT * FROM uyeler WHERE mail='$mail'");

    /* Veritabanından Gelen Değeri Kontrol Edilebilir Yapmak İçin mysql_num_rows */
    $kontrol_kadi_ref= mysqli_num_rows($kontrol_kadi);
    $kontrol_mail_ref= mysqli_num_rows($kontrol_mail);

    /* Bazı Kontroller */
    if(!isset($_GET['kkk'])) {
        echo'<div class="container theme-showcase" role="main">
                            <div class="alert alert-danger">
                                <strong>Hata !</strong> Lütfen Kullanım Koşullarını Kabul Edin .
                              </div>
                              </div>';
    } else if($kontrol_mail_ref) {
        echo'<div class="container theme-showcase" role="main">
                            <div class="alert alert-danger">
                                <strong>Hata !</strong> Bu Mail Adresine Sahip Üye Bulunmakta .
                              </div>
                              </div>';
    } else if($kontrol_kadi_ref) {
        echo'<div class="container theme-showcase" role="main">
                            <div class="alert alert-danger">
                                <strong>Hata !</strong> Bu Kullanıcı Adına Sahip Üye Bulunmakta .
                              </div>
                              </div>';
    } else if(strlen($kullanici_adi)<5 || strlen($kullanici_adi)>30){
        echo'<div class="container theme-showcase" role="main">
                            <div class="alert alert-danger">
                                <strong>Hata !</strong> Kullanıcı Adınız 5 Ile 30 Karakter Arasında Olmalıdır .
                              </div>
                              </div>';
    } else if(strlen($sifre)<5 || strlen($sifre)>30){
        echo'<div class="container theme-showcase" role="main">
                            <div class="alert alert-danger">
                                <strong>Hata !</strong> Şifreniz 5 Ile 30 Karakter Arasında Olmalıdır .
                              </div>
                              </div>';
    } else if($sifre!=$sifre_kontrol){
        echo'<div class="container theme-showcase" role="main">
                            <div class="alert alert-danger">
                                <strong>Hata !</strong> Şifreler Uyuşmuyor .
                              </div>
                              </div>';
    } else {
        /* Şifreyi Şifreliyoruz :D */
        $guvenli_sifre=sifrele($sifre);

        /* Işlemlerimizi Yaptıralım */
        $sql = @mysqli_query($db,"INSERT INTO uyeler (kullanici_adi,sifre,mail) VALUES ('$kullanici_adi','$guvenli_sifre','$mail')");

        if($sql) {
            echo '<div class="container theme-showcase" role="main">
                            <div class="alert alert-success">
                                <strong>Tebrikler !</strong> Sistemimize Başarıyla Kayıt Oldunuz .
                              </div>
                              </div>';
        } else {
            echo'<div class="container theme-showcase" role="main">
                            <div class="alert alert-danger">
                                <strong>Hata !</strong> Tanımlanamayan Bir Sorun Oluştu .
                              </div>
                              </div>';
        }
    }
}

?><!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Foruma Üye Kaydı Yapılabilecek Sayfa">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Forum Kayıt Sayfası</title>

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

  <body>

    <div class="container">

      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">Kayıt Ol</h2>
        <input name="kullanici_adi" type="text" class="form-control" placeholder="Kullanıcı Adı" required>
        <input name="sifre" type="password" class="form-control" placeholder="Şifre" required>
        <input name="sifre_kontrol" type="password" class="form-control" placeholder="Şifre(Tekrar)" required>
        <input name="mail" type="email" class="form-control" placeholder="Mail Adresi" required>

        <label class="checkbox">
          <input name="kkk" type="checkbox" value="remember-me"> Kullanım Koşullarını Kabul Ediyorum
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Kayıt Ol</button>
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
