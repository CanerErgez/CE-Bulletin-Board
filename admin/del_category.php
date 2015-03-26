<?php
/* Session ve OB Değerlerini Açtık */
session_start(); ob_start();
/* Gerekli Dosyları Çağırdık */
require_once '../database.php';
require_once '../functions/encrypt.php';
?>
<?php
/* Admin Kontrolü */
if($_SESSION['kullanici_rutbe']==1) {
?>
<?php
/* İşlev Kodları */
	$sql=mysqli_query($db,"SELECT * FROM kategoriler");

/* Güncelleme İçin Kodlar */
	if(isset($_GET['kategori_id'])) {
	$kategori_id=htmlspecialchars(mysqli_real_escape_string($db,trim($_GET['kategori_id'])));

	$sql=mysqli_query($db,"DELETE FROM kategoriler WHERE id='$kategori_id'");

	$forumlar_al=mysqli_query($db,"SELECT * FROM forumlar WHERE kat_id='$kategori_id'");
	while($forumlar_mfa=mysqli_fetch_array($forumlar_al,MYSQLI_ASSOC)) {
		$forum_id=$forumlar_mfa['id'];
		$konular_al=mysqli_query($db,"SELECT * FROM konular WHERE f_id='$forum_id'");
			while($konular_mfa=mysqli_fetch_array($konular_al,MYSQLI_ASSOC)) {
				$konu_id=$konular_mfa['id'];
				$cevaplar_sil=mysqli_query($db,"DELETE FROM cevaplar WHERE konu_id='$konu_id'");
				if(!$cevaplar_sil) {
				die;
				echo 'Cevaplar Silinemedi';
				}
			}
		$konular_sil=mysqli_query($db,"DELETE FROM konular WHERE f_id='$forum_id'");
		if(!$konular_sil) {
				die;
				echo 'Konular Silinemedi';
				}
	}
	$forumlar_sil=mysqli_query($db,"DELETE FROM forumlar WHERE kat_id='$kategori_id'");
	if(!$forumlar_sil) {
				die;
				echo 'Forumlar Silinemedi';
				}

	if($sql) {
		echo '<div class="container theme-showcase" role="main">
                    <div class="alert alert-success">
                        <strong>Tebrikler !</strong> Kategori Başarıyla Silindi .
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
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">

    <title>CE Bulletin Borad Admin Paneli - Site Ayarları</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

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
            <li class="active"><a href="del_category.php">Kategori Sil</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="add_forum.php">Forum Ekle</a></li>
            <li><a href="up_forum.php">Forum Düzenle</a></li>
            <li><a href="del_forum.php">Forum Sil</a></li>
          </ul>
		  <ul class="nav nav-sidebar">
            <li><a href="up_user.php">Kullanıcı Düzenle</a></li>
            <li><a href="del_user.php">Kullanıcı Sil</a></li>
          </ul>
		  <ul class="nav nav-sidebar">
            <li><a href="../index.php">Çıkış</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Kategori Silme</h1>
		<?php
		while($kategori_info=mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
		?>

		  <form class="form-signin" role="form" action="del_category.php" method="GET">
			<input type="hidden" name="kategori_id" value="<?php echo $kategori_info['id']; ?>" />
			<input type="text" class="form-control" value="<?php echo $kategori_info['kategori_ad']; ?>" /><br />
			<input type="text" class="form-control" value="<?php echo $kategori_info['kategori_aciklama']; ?>"  /><br />
			<center>
			<button class="btn btn-lg btn-danger" type="submit">Sil</button><br /><br />
			</center>
		</form>

		<?php
			}
		?>


        <footer>
				<div class="page-header">
				</div>
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
echo '<meta http-equiv="refresh" content="5;URL=index.php">';
} ?>
