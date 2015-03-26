<?php
if(!file_exists("database.php")) {
  if(isset($_POST['local']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['db'])) {

  $degiskenlocal=$_POST['local'];
  $degiskenuser=$_POST['user'];
  $degiskenpass=$_POST['pass'];
  $degiskendb=$_POST['db'];

  $local='$local';
  $user='$user';
  $pass='$pass';
  $db='$db';
  $baglanti='$db';



    if(new mysqli($degiskenlocal,$degiskenuser,$degiskenpass,$degiskendb) or die) {
      $yaz="<?php

      $local='localhost';
      $user='KADİ';
      $pass='PASS';
      $db='DB';

      $baglanti=mysqli_connect($local,$user,$pass,$db) or die (\"Error\" . mysqli_error($baglanti));

      error_reporting(0);

?>";

      if(touch("database.php")){
          $olustur=fopen("database.php","w");

          $yaz=str_replace("localhost",$degiskenlocal,$yaz);
          $yaz=str_replace("KADİ",$degiskenuser,$yaz);
          $yaz=str_replace("PASS",$degiskenpass,$yaz);
          $yaz=str_replace("DB",$degiskendb,$yaz);

          fwrite($olustur,$yaz);

          fclose($olustur);

          echo '<meta http-equiv="refresh" content="1;URL=install_db.php">';
      } else {
        echo 'Dosya Oluşturulamadı';
      }


    } else {
      echo 'Verilen Bilgilerden Yanlış .';
    }
  }
} else {
  echo 'Zaten Kurulum Yapılmış .';
  header("Location:database.php");
}
?>


<html>
<head>
  <meta charset="utf-8">
  <title>Kurulum Sayfası</title>
  <head>
    <body>
      <h2>Kurulum Bilgileri</h2>
      <form action="" method="POST">
        <input type="text" name="local" value="localhost"/>
        <input type="text" name="user" value="user"/>
        <input type="text" name="pass" value="password"/>
        <input type="text" name="db" value="db name"/>
        <input type="submit" value="Gönder"/>
      </form>
    </body>
    </html>
