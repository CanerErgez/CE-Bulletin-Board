-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 27 Oca 2015, 15:59:57
-- Sunucu sürümü: 5.6.17
-- PHP Sürümü: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `forum`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE IF NOT EXISTS `ayarlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteadi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT 'CE Bulletin Board',
  `sitedurum` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `siteadi`, `sitedurum`) VALUES
(1, 'CE Bulletin Board', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cevaplar`
--

CREATE TABLE IF NOT EXISTS `cevaplar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `konu_id` int(11) NOT NULL,
  `gonderen` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `forumlar`
--

CREATE TABLE IF NOT EXISTS `forumlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kat_id` int(11) NOT NULL,
  `forum_ad` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `forum_aciklama` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Tablo döküm verisi `forumlar`
--

INSERT INTO `forumlar` (`id`, `kat_id`, `forum_ad`, `forum_aciklama`) VALUES
(4, 6, 'Forum', 'Forum1 AÃ§Ä±klama');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE IF NOT EXISTS `kategoriler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_ad` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kategori_aciklama` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `konular` int(11) NOT NULL,
  `songonderen` int(11) DEFAULT NULL,
  `konu_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `kategori_ad`, `kategori_aciklama`, `konular`, `songonderen`, `konu_link`) VALUES
(6, 'Deneme', 'Deneme', 0, 0, '43');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `konular`
--

CREATE TABLE IF NOT EXISTS `konular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_id` int(11) NOT NULL,
  `gonderen` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `isim` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `cevaplar` int(11) NOT NULL DEFAULT '0',
  `songonderen` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Tablo döküm verisi `konular`
--

INSERT INTO `konular` (`id`, `f_id`, `gonderen`, `isim`, `aciklama`, `cevaplar`, `songonderen`) VALUES
(43, 4, 'ceBB Bot', 'Ornek Konu', 'Deneme Bir Konu Ornegi', 0, 'ceBB Bot');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE IF NOT EXISTS `uyeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanici_adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `rutbe` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `kullanici_adi`, `sifre`, `mail`, `rutbe`) VALUES
(1, 'admin', 'fa1c13f091633316fd8c2cc646cee8fa4976c0fa', 'admin@cebb.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
