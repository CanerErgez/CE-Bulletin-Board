<?php
/* Session ve OB Değerlerini Açtık */
session_start(); ob_start();
/* Gerekli Dosyları Çağırdık */
require_once '../database.php';
require_once '../functions/encrypt.php';
?>
<?php /* Admin Kontrolü */
if($_SESSION['kullanici_rutbe']==1) {
?>
<?php
/* Güncelleme İçin Kodlar */
	if(isset($_GET['kullanici_adi']) && isset($_GET['kullanici_rutbe'])) {
	$kullanici_adi=htmlspecialchars(mysqli_real_escape_string($db,trim($_GET['kullanici_adi'])));
	$kullanici_rutbe=htmlspecialchars(mysqli_real_escape_string($db,trim(intval($_GET['kullanici_rutbe']))));

	$sql=mysqli_query($db,"UPDATE uyeler SET rutbe='$kullanici_rutbe' WHERE kullanici_adi='$kullanici_adi'");

	if($sql) {
		echo '<div class="container theme-showcase" role="main">
                    <div class="alert alert-success">
                        <strong>Tebrikler !</strong> Uye Başarıyla Güncellendi .
						<meta http-equiv="refresh" content="2;URL=index.php">
                    </div>
               </div>';
	} else {
		echo'<div class="container theme-showcase" role="main">
                            <div class="alert alert-danger">
                                <strong>Hata !</strong> Tanımlanamayan Bir Sorun Oluştu .
								<meta http-equiv="refresh" content="5;URL=index.php">
                              </div>
                              </div>';
	}
}
?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kullanıcı Güncelleme Paneli">
    <meta name="author" content="CanerErgez">
    <title>CE Bulletin Borad Admin Paneli</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.php">CE Bulletin Board</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Hoşgeldiniz Sayın <?php echo $_SESSION['kullanici']; ?></a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="index.php">Genel</a></li>
			<li><a href="settings.php">Site Ayarları</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="add_category.php">Kategori Ekle</a></li>
            <li><a href="up_category.php">Kategori Düzenle</a></li>
            <li><a href="del_category.php">Kategori Sil</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="add_forum.php">Forum Ekle</a></li>
            <li><a href="up_forum.php">Forum Düzenle</a></li>
            <li><a href="del_forum.php">Forum Sil</a></li>
          </ul>
		  <ul class="nav nav-sidebar">
            <li class="active"><a href="up_user.php">Kullanıcı Düzenle</a></li>
            <li><a href="del_user.php">Kullanıcı Sil</a></li>
          </ul>
		  <ul class="nav nav-sidebar">
            <li><a href="../index.php">Çıkış</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Kullanıcı Güncelle</h1>

		  <form class="form-signin" role="form" action="up_user.php" method="GET">
		  Lütfen Değişiklik Yapmak Istediğiniz Üye Kullanıcı Adını HATASIZ Giriniz . Rutbe Değişikliği Yapmak İçin Gerekli Değeri Giriniz. (1-Admin , 0-Kullanıcı)
			<input type="text" class="form-control" name="kullanici_adi" placeholder="Kullanıcı Adı" /><br />
			<input type="text" class="form-control" name="kullanici_rutbe" placeholder="0"  /><br />
			<center>
			<button class="btn btn-lg btn-primary" type="submit">Düzenle</button><br /><br />
			</center>
		</form>

        <footer>
				<div class="page-header"> </div>
					<div class="well">
						<center><p>CanerErgez® | 2014</p></center>
					</div>
		</footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../assets/js/docs.min.js"></script>
  </body>
</html>
<?php } else {
echo'Bu Sayfaya Giriş İzniniz Yoktur .';
echo '<meta http-equiv="refresh" content="2;URL=../login.php">';
} ?>
