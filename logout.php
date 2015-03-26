<?php
session_start(); ob_start(); //sessionlarımızı başlattık

$cikis_kontrol=session_destroy();

$_SESSION['giris'] = false;
?>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Çıkış Yapma Sayfası">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Çıkış Sayfası</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">
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

        <div class="container theme-showcase" role="main">

<?php
if($cikis_kontrol) {
    echo '<div class="alert alert-success">
        <strong>Tebrikler!</strong> Başarıyla Çıkış Yaptınız .
      </div>';
    echo '<meta http-equiv="refresh" content="5;URL=index.php">';
} else {
    echo '<div class="alert alert-danger">
        <strong>Hata !</strong> Bir Sorun Oluştu .
      </div>';
    echo '<meta http-equiv="refresh" content="5;URL=index.php">';
}
?>
        </div>
    </div>
   </body>
</html>
