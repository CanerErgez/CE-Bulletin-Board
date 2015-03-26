<?php
/* �ifreleme Fonksiyonumuzu Olu�turduk */
function sifrele ($key) {

    /* I�lemleri Yapt�rd�k */
    $key=sha1(md5(md5(sha1($key))));

    /* �ifelenen De�eri Geri D�nd�rd�k */
    return $key;
}

/* AltSat�r Fonksiyonunu Olu�tural�m */
function altsatirfunction($yazi){

	/* i�levler */
	$yazi=str_replace("\n","<br>",$yazi);

	/* D�nen De�er */
	return $yazi;
}

/* AltSat�r Fonksiyonunu Olu�tural�m */
function altsatirfunction_decode($yazi){

	/* i�levler */
	$yazi=str_replace("<br>","",$yazi);

	/* D�nen De�er */
	return $yazi;
}

/* �NEMLI NOT : Gulumsemeler Ilk Versiyonda �al��mad� ... */
function gulumsemeler($metin) {
	/* Yap�lacak ��lemler */
	$metin=str_replace(":D","<img src='smilies/biggrin.png' border='0' />",$metin);
	$metin=str_replace(":s","<img src='smilies/confused.png' border='0' />",$metin);
	$metin=str_replace(":S","<img src='smilies/confused.png' border='0' />",$metin);
	$metin=str_replace("8)","<img src='smilies/cool.png' border='0' />",$metin);
	$metin=str_replace(":'(","<img src='smilies/cry.png' border='0' />",$metin);
	$metin=str_replace(":@","<img src='smilies/devilish.png' border='0' />",$metin);
	$metin=str_replace(":(","<img src='smilies/frown.png' border='0' />",$metin);
	$metin=str_replace("O.o","<img src='smilies/O_o.png' border='0' />",$metin);
	$metin=str_replace("o.O","<img src='smilies/O_o.png' border='0' />",$metin);
	$metin=str_replace(":poop","<img src='smilies/poop.png' border='0' />",$metin);
	$metin=str_replace(":x","<img src='smilies/sick.png' border='0' />",$metin);
	$metin=str_replace(":X","<img src='smilies/sick.png' border='0' />",$metin);
	$metin=str_replace(":)","<img src='smilies/smile.png' border='0' />",$metin);
	$metin=str_replace(":|","<img src='smilies/speechless.png' border='0' />",$metin);
	$metin=str_replace(":ok","<img src='smilies/thumbsup.png' border='0' />",$metin);
	$metin=str_replace(":P","<img src='smilies/tongue.png' border='0' />",$metin);
	$metin=str_replace(":p","<img src='smilies/tongue.png' border='0' />",$metin);
	$metin=str_replace("-.-","<img src='smilies/unsure.png' border='0' />",$metin);
	$metin=str_replace(":3","<img src='smilies/x3.png' border='0' />",$metin);

	/* Smileyli De�eri Geri G�nderdik */
	return $metin;
}

function gulumsemeler_decode($metin) {
	/* Yap�lacak ��lemler */
	$metin=str_replace("<img src='smilies/biggrin.png' border='0' />",":D",$metin);
	$metin=str_replace("<img src='smilies/confused.png' border='0' />",":S",$metin);
	$metin=str_replace("<img src='smilies/cool.png' border='0' />","8)",$metin);
	$metin=str_replace("<img src='smilies/cry.png' border='0' />",":'(",$metin);
	$metin=str_replace("<img src='smilies/devilish.png' border='0' />",":@",$metin);
	$metin=str_replace("<img src='smilies/frown.png' border='0' />",":(",$metin);
	$metin=str_replace("<img src='smilies/O_o.png' border='0' />","O.o",$metin);
	$metin=str_replace("<img src='smilies/poop.png' border='0' />",":poop",$metin);
	$metin=str_replace("<img src='smilies/sick.png' border='0' />",":x",$metin);
	$metin=str_replace("<img src='smilies/smile.png' border='0' />",":)",$metin);
	$metin=str_replace("<img src='smilies/speechless.png' border='0' />",":|",$metin);
	$metin=str_replace("<img src='smilies/thumbsup.png' border='0' />",":ok",$metin);
	$metin=str_replace("<img src='smilies/tongue.png' border='0' />",":P",$metin);
	$metin=str_replace("<img src='smilies/unsure.png' border='0' />","-.-",$metin);
	$metin=str_replace("<img src='smilies/x3.png' border='0' />",":3",$metin);

	/* Smileyli De�eri Geri G�nderdik */
	return $metin;
}
