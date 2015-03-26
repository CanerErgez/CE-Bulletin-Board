<?php
/* Session ve OB Değerlerini Açtık */
session_start(); ob_start();
/* Gerekli Dosyaları Çağırdık */
require_once 'database.php';
require_once 'functions/encrypt.php';
require_once 'functions/site.php';
?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Forum Yönetici Listesi">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Forum Yönetici Listesi</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body role="document">

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><?php echo $cebb_site_adi; ?></a>
        </div>
          <?php
if(!$_SESSION['giris']){ /* Giriş Yaplımadıysa Üye Formu , Yapıldıysa Hoşgeldin Metni. */
    echo '<div class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" action="login.php" role="form" method="get">
            <div class="form-group">
              <input name="kullanici_giris" type="text" placeholder="Kullanıcı Adı" class="form-control">
            </div>
            <div class="form-group">
              <input name="sifre_giris" type="password" placeholder="Sifre" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Giriş Yap</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>';
} else {
    echo '<div class="nav nav-pills pull-right">
            <span class="navbar-brand">Hosgeldiniz Sayin '.$_SESSION['kullanici'].' |</span> <a class="navbar-brand" href="logout.php">[Çıkış Yap]</a>
        </div><!--/.navbar-collapse -->
      </div>
    </div>';
}
?>
    <nav>
      <div class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Sayfalar : </a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php">Anasayfa</a></li>
              <li><a href="#about">Hakkında</a></li>
              <li><a href="#contact">İletişim</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </nav>

	<div class="container">
        <div class="page-header">
            <h1>Forum Adminleri</h1>
        </div>
    </div>
		<?php
		$sql=mysqli_query($db,"SELECT * FROM uyeler WHERE rutbe='1'");
		?>
	<div class="container">
		<?php
		while($sql_admin=mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
		?>
		<h3><?php echo $sql_admin['kullanici_adi']; ?></h3><br />
		<?php
		}
		?>
	</div>


	<footer>
       <div class="container">
          <div class="page-header"> </div>
      <div class="well">
          <center><p>CanerErgez® | 2014</p></center>
      </div>
       </div>
    </footer>
    </body>
</html>
