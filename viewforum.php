<?php
/* Session ve OB Değerlerini Açtık */
session_start(); ob_start();
/* Gerekli Dosyaları Çağırdık */
require_once 'database.php';
require_once 'functions/encrypt.php';
require_once 'functions/site.php';
?>
    <?php
    /* Forum İçin Gelen Değeri Aldık ve Listeleme Yapıyoruz ... */
        $forum_gelen=@intval($_GET['forum']);
        $sayfa =@intval($_GET['sayfa']);

		if(!$sayfa) $sayfa=1;

        $sql=  mysqli_query($db,"SELECT * FROM forumlar WHERE id='$forum_gelen'");
        $forum_info=  mysqli_fetch_array($sql,MYSQLI_ASSOC);
    ?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Forum Sayfası">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title><?php echo $forum_info['forum_ad']; ?></title>

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
                    <h1><?php echo $forum_info['forum_ad']; ?></h1>
                </div>
				<?php
				if($_SESSION['giris']){ /* Giriş Yaplımadıysa Seçenekleri Gösterme . */
				?>
                <button onclick="window.location.href='addtopic.php?f_id=<?php echo $forum_gelen; ?>'" type="button" class="btn btn-primary">Yeni Konu</button><br /><br />
				<?php } ?>
			</div>



      <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">
                <div class="col-sm-6">
                    Konular
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



    <?php /* SAYFALAMA */

	$limit=10;

	$toplam=mysqli_num_rows(mysqli_query($db,"SELECT * FROM konular WHERE f_id='$forum_gelen'"));

	$goster=$sayfa*$limit-$limit;

	$sql_topic = mysqli_query($db,"SELECT * FROM konular WHERE f_id='$forum_gelen' ORDER BY id LIMIT $goster,$limit");

    while($sql_topic_var = mysqli_fetch_array($sql_topic,MYSQLI_ASSOC)) {
    ?>
              <div class="container">
      <div class="row">
        <div class="col-sm-12">
		  <div class="panel panel-default">
          <div class="panel-body">
                <div class="col-sm-6">
                  <a href="viewtopic.php?topic=<?php echo $sql_topic_var['id'] ?>"><?php echo $sql_topic_var['isim']; ?></a>
                    <!-- İkonlar Eklenecek .. -->
                  <?php
                  if($_SESSION['giris']) {/* Giriş Yapılmışsa */
                    if($_SESSION['kullanici']==$sql_topic_var['gonderen'] || $_SESSION['kullanici_rutbe']==1){ /* Konuyu Gönderen veya Adminse , Göster */
                      ?>
                      <br/><button onclick="window.location.href='topic_up.php?id=<?php echo $sql_topic_var['id']; ?>'" type="button"><img src="icons/B64_09.png" border="none" width="16" height="16"/></button>  <button onclick="window.location.href='topic_del.php?id=<?php echo $sql_topic_var['id']; ?>'" type="button"><img src="icons/B64_84.png" border="none" width="16" height="16"/></button>
                      <?php
                    }}
                    ?>
                    <!--#Ikon Eklemesi Bitti ! -->
                </div>
                <div class="col-sm-3">
                    <?php
					$konu_idsi=$sql_topic_var['id'];
					$cevaplar = 0;

					$sql_cevaplar=mysqli_query($db,"SELECT * FROM cevaplar WHERE konu_id='$konu_idsi'");

					while(mysqli_fetch_array($sql_cevaplar,MYSQLI_ASSOC)){
					$cevaplar=$cevaplar+1;
					}
					?>
					Cevaplar : <?php echo $cevaplar; ?>
                </div>
                <div class="col-sm-3">
                    Gönderen : <?php echo $sql_topic_var['songonderen'] ?>
                </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    <?php } ?>

     <div class="container">
		<center>
<?php /* SAYFALAMA */

$sayfa_sayisi=ceil($toplam/$limit);

$forlimit = 3;

	echo '<ul class="pagination"><li><a href="viewforum.php?forum='.$forum_gelen.'&sayfa=1">[Ilk Sayfa]</a></li>';

for($i=$sayfa-$forlimit; $i<$sayfa+$forlimit+1; $i++) {
	if($i>0 && $i<=$sayfa_sayisi) {
			if($i== $sayfa) {
        echo '<li><a href=""><'.$i.'></a></li>';
      } else {
				echo '<li><a href="viewforum.php?forum='.$forum_gelen.'&sayfa='.$i.'">['.$i.']</a></li>';
			}
	}
}

	echo '<li><a href="viewforum.php?forum='.$forum_gelen.'&sayfa='.$sayfa_sayisi.'">[Son Sayfa]</a></li></ul>';
?>
		  </center>
		  </div>
          <?php
				if($_SESSION['giris']){ /* Giriş Yaplımadıysa Üye Formu , Yapıldıysa Hoşgeldin Metni. */
			?>
         <div class="container">
				<br/>
                <button onclick="window.location.href='addtopic.php?f_id=<?php echo $forum_gelen; ?>'" type="button" class="btn btn-primary">Yeni Konu</button><br /><br />
            </div>
          <?php } ?>


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
