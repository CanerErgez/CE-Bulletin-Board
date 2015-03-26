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
<body>

  <div class="container">
    <div class="alert alert-success">
      <strong>Tebrikler !</strong> Kurulum Başarıyla Tamamlandı !
    </div>
  </div>

  <h3>Giriş Bilgileri</h3><br>

  <b>Kullanıcı Adı :</b> admin <br>
  <b>Şifre :</b> admin <br><br>

  <?php
  unlink("installer.php");
  unlink("forum.sql");
  unlink("install_db.php");

  if(!(file_exists("installer.php") && file_exists("forum.sql") && file_exists("install_db.php")))
  echo '<a href="login.php">Giriş Yapmak İçin Tıklayın</a>';
  ?>
</body>
</html>
