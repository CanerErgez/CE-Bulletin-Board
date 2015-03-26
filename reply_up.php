<?php
/* Session ve OB Değerlerini Açtık */
session_start(); ob_start();
/* Gerekli Dosyları Çağırdık */
require_once 'database.php';
require_once 'functions/encrypt.php';
require_once 'functions/site.php';
?>
<?php
	if($_SESSION['giris']){ /* Giriş Yapılmışsa Sayfayı Yükle */
?>
<?php
/* Formdan Veri Gelmiş Mi Diye Kontrol Ettik */
if(isset($_POST['cevap_aciklama']) && isset($_POST['guncel_reply_id'])) {
    $cevap_aciklama=mysqli_real_escape_string($db,altsatirfunction(gulumsemeler(trim($_POST['cevap_aciklama']))));
	$cevap_for_id=htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['guncel_reply_id'])));

	$konu_id_cek=mysqli_query($db,"SELECT konu_id FROM cevaplar WHERE id='$cevap_for_id'");
	$konu_id_cek_mfa=mysqli_fetch_array($konu_id_cek,MYSQLI_ASSOC);
	$konu_id=$konu_id_cek_mfa['konu_id'];

	$sql = mysqli_query($db,"UPDATE cevaplar SET aciklama='$cevap_aciklama' WHERE id='$cevap_for_id'");


		if($sql) {
		echo '<div class="container theme-showcase" role="main">
                    <div class="alert alert-success">
                        <strong>Tebrikler !</strong> Cevabınız Başarıyla Güncellendi .
						<meta http-equiv="refresh" content="1;URL=viewtopic.php?topic='.$konu_id.'">
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
} else if(isset($_GET['id'])) {
    $reply_id=htmlspecialchars(mysqli_real_escape_string($db,trim($_GET['id'])));

	$sql_cevap_cek=mysqli_query($db,"SELECT * FROM cevaplar WHERE id='$reply_id'");
	$sql_cevap = mysqli_fetch_array($sql_cevap_cek,MYSQLI_ASSOC);

	if($_SESSION['kullanici']!=$sql_cevap['gonderen']){
		if($_SESSION['kullanici_rutbe']!=1) {
	echo 'Bu Bölüme Giriş İzniniz Bulunmamaktadır .';
	die;
	}}
} else { /* GET veya POST Gelmediyse Hata Verdik ve Sayfayı Öldürdük . */
	echo'Yanlış Bir URL Girdiniz.';
	die;
 }
?>

<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cevap Güncelleme Sayfası">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Cevap Güncelleme</title>

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
            <div class="page-header">
                <h1>Cevap Yaz</h1>
            </div>
    </div>
	<div class="container">
		<form class="form-signin" role="form" action="reply_up.php" method="POST">
			<input name="guncel_reply_id" type="hidden" value="<?php echo $reply_id; ?>">
			<textarea class="form-control" rows="10" name="cevap_aciklama" required><?php echo gulumsemeler_decode(altsatirfunction_decode($sql_cevap['aciklama'])); ?></textarea><br/>
			<center>
			<button class="btn btn-lg btn-primary" type="submit">Gönder</button>
			<button class="btn btn-lg btn-danger" type="reset" >Temizle</button>
			</center>
		</form>
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
		<script src="js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
		tinymce.init({
			selector: "textarea",
			plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		});
		</script>
</html>
<?php } else {
echo'Bu Sayfaya Giriş İzniniz Yoktur .';
echo '<meta http-equiv="refresh" content="5;URL=index.php">';
} ?>
