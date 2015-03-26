<?php
/* Session ve OB Değerlerini Açtık */
session_start(); ob_start();
/* Gerekli Dosyaları Çağırdık */
require_once 'database.php';
require_once 'functions/encrypt.php';
require_once 'functions/site.php';
?>
    <?php
    /* Konu İçin Gelen Değeri Aldık ve Listeleme Yapıyoruz ... */
        $topic_gelen=@intval($_GET['topic']);
		$sayfa =@intval($_GET['sayfa']);

		if(!$sayfa) $sayfa=1;

        $sql=  mysqli_query($db,"SELECT * FROM konular WHERE id='$topic_gelen'");
        $topic_info=  mysqli_fetch_array($sql,MYSQLI_ASSOC);

		if(empty($topic_info)) {
		echo 'Hatalı Bir Giriş Yapmaya Çalıştınız';
		die;
		}

        $topic_id=$topic_info['id'];
    ?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Konu Sayfası">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title><?php echo $topic_info['isim']; ?></title>

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
              <li><a href="#contact">Iletişim</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </nav>

        <div class="container">
                <div class="page-header">
                    <h1><?php echo $topic_info['isim']; ?></h1>
                </div>
                <?php
				if($_SESSION['giris']){ /* Giriş Yaplımadıysa Üye Formu , Yapıldıysa Hoşgeldin Metni. */
			?>
			<button onclick="window.location.href='addreply.php?topic=<?php echo $topic_gelen; ?>'" type="button" class="btn btn-primary">Cevap Yaz</button><br /><br />
			<?php } ?>
            </div>
          <?php  if($sayfa==1) { ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                         <div class="panel-heading">
                            <h3 class="panel-title">
                               Konuyu Oluşturan : <?php echo $topic_info['gonderen']; ?>
                            </h3>
                        </div>
                        <div class="panel-body">
                                 <?php echo $topic_info['aciklama']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php } ?>


        <?php /* SAYFALAMA */

		$limit=10;

		$toplam=mysqli_num_rows(mysqli_query($db,"SELECT * FROM cevaplar WHERE konu_id='$topic_id'"));

		$goster=$sayfa*$limit-$limit;

        $sql_reply=mysqli_query($db,"SELECT * FROM cevaplar WHERE konu_id='$topic_id' ORDER BY id LIMIT $goster,$limit");

        while($sql_reply_var=  mysqli_fetch_array($sql_reply,MYSQLI_ASSOC)) {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

					<div class="panel panel-default">
                         <div class="panel-heading">
                            <h3 class="panel-title">
                              Cevaplayan : <?php echo $sql_reply_var['gonderen']; ?>
                              <?php
                              if($_SESSION['giris']) {/* Giriş Yapılmışsa */
                                if($_SESSION['kullanici']==$sql_reply_var['gonderen'] || $_SESSION['kullanici_rutbe']==1){ /* Konuyu Gönderen veya Adminse , Göster */
                                  ?>
                                  <button onclick="window.location.href='reply_up.php?id=<?php echo $sql_reply_var['id']; ?>'" type="button"><img src="icons/B64_09.png" border="none" width="16" height="16"/></button>  <button onclick="window.location.href='reply_del.php?id=<?php echo $sql_reply_var['id']; ?>'" type="button"><img src="icons/B64_84.png" border="none" width="16" height="16"/></button><br/ >
                                  <?php
                                }}
                                ?>
                            </h3>
                        </div>
                        <div class="panel-body">
                                 <?php echo $sql_reply_var['aciklama']; ?>
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

		echo '<ul class="pagination"><li><a href="viewtopic.php?topic='.$topic_gelen.'&sayfa=1">[Ilk Sayfa]</a></li>';

		for($i=$sayfa-$forlimit; $i<$sayfa+$forlimit+1; $i++) {
			if($i>0 && $i<=$sayfa_sayisi) {
					if($i== $sayfa) {
						echo '<li><a href=""><'.$i.'></a></li>';
					} else {
						echo '<li><a href="viewtopic.php?topic='.$topic_gelen.'&sayfa='.$i.'">['.$i.']</a></li>';
					}
			}
		}

	echo '<li><a href="viewtopic.php?topic='.$topic_gelen.'&sayfa='.$sayfa_sayisi.'">[Son Sayfa]</a></li></ul>';
	?>
		</center>
		</div>

		<?php
        if($_SESSION['giris']){ /* Giriş Yaplımadıysa Üye Formu , Yapıldıysa Hoşgeldin Metni. */
		?>
		<div class="container">
    <button onclick="window.location.href='addreply.php?topic=<?php echo $topic_gelen; ?>'" type="button" class="btn btn-primary">Cevap Yaz</button><br /><br />
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
