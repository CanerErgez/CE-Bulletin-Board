<?php
$sql=mysqli_query($db,"SELECT * FROM ayarlar");
$sql_mfa=mysqli_fetch_array($sql,MYSQLI_ASSOC);

if(!$sql_mfa['sitedurum'] && $_SESSION['kullanici_rutbe']==0) {
echo 'Site Bakimdadir . Yonetici Iseniz Giris Yapmak Icin <a href="login.php">Tiklayin</a>';
die;
}

$cebb_site_adi=$sql_mfa['siteadi'];
?>
