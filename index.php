<?php
/* Session ve OB Değerlerini Açtık */
session_start(); ob_start();
/* Gerekli Dosyları Çağırdık */
if(!file_exists("database.php")) header("Location:installer.php");

require_once 'database.php';
require_once 'functions/encrypt.php';
require_once 'functions/site.php';
?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Forum Ana Sayfası</title>

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
if(!$_SESSION['giris']){ /* Giiş Yapılmadıysa Üye Formu , Yapıldıysa Hoşgeldin Metni. */
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
              <li><a href="#contact">Iletişim</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </nav>

        <div class="container">
		<?php
			if(!$_SESSION['giris']){ /* Giriş Yapılmamışsa Uyarı Yükle */
		?>
			<div class="alert alert-warning">
				<strong>Dikkat!</strong> Forumumuza Üye Değilseniz , Hemen <a href="register.php" target="_blank">Buradan</a> Kayıt Olabilirsiniz .
			</div>
		<?php
			}
		?>
				<div class="page-header">
					<h1>Forumlar</h1>
				</div>
        </div>
    <?php
    /* Kategori ve Forum Listelemeleri */
    $sql_kategori = mysqli_query($db,"SELECT * FROM kategoriler");


    while($sql_kategori_var = mysqli_fetch_array($sql_kategori,MYSQLI_ASSOC)) {
    ?>
      <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">
                <div class="col-sm-6">
                    <?php echo $sql_kategori_var['kategori_ad']; ?>
                </div>
                <div class="col-sm-3">
                    Istatistik
                </div>
                    Son Gönderi
              </h3>
            </div>
            </div>
        </div>
      </div>
      </div>



    <?php
    $sql_forum = mysqli_query($db,"SELECT * FROM forumlar");

    while($sql_forum_var = mysqli_fetch_array($sql_forum,MYSQLI_ASSOC)) {
	$sql_konular_id=$sql_forum_var['id'];

    $sql_konular_istatistik=mysqli_query($db,"SELECT * FROM konular WHERE f_id='$sql_konular_id'");
	$konular_sql_sayi=0;
	$sql_konu_id_fix=0;
	while($sql_konu_id_fix_ref = mysqli_fetch_array($sql_konular_istatistik,MYSQLI_ASSOC)) {
	$konular_sql_sayi = $konular_sql_sayi+1;
	$sql_konu_id_fix = $sql_konu_id_fix_ref['id'];
	$sql_konu_ad_fix = $sql_konu_id_fix_ref['isim'];
	}

	if($sql_forum_var['kat_id'] == $sql_kategori_var['id']) {
    ?>
              <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default">
          <div class="panel-body">
                <div class="col-sm-6">
                    <a href="viewforum.php?forum=<?php echo $sql_forum_var['id'] ?>"><?php echo $sql_forum_var['forum_ad']; ?></a>
                </div>
                <div class="col-sm-3">
                    Toplam Konu : <?php echo $konular_sql_sayi; ?>
					<?php $konular_sql_sayi=0; ?>
                </div>
                <div class="col-sm-3">
					<?php
					if(!$sql_konu_id_fix==0){
                    echo '<a href="viewtopic.php?topic='.$sql_konu_id_fix.'" >'.$sql_konu_ad_fix.'</a>';
					} else {
					echo 'Henüz Konu Oluşturulmadı.';
					}?>
                </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    <?php }}} ?>

    <footer>
        <div class="container">
            <center><a href="admin-list.php">[Forum Yetkililerini Göster]</a></center>
        </div>
       <div class="container">
          <div class="page-header"> </div>
      <div class="well">
          <center><p>CanerErgez® | 2014</p></center>
      </div>
       </div>
    </footer>
    </body>
</html>
