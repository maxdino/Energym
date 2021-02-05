<?php 
session_start();
require 'classphp/PasswordLib/PasswordLib.php';
header("Content-Type: image/png");
 function Generecarter($lengt){
	$captcha=null;
    //Areglo  de caracteres
	$carater=array(
	1,2,3,4,5,6,7,8,9,0,
	'a','b','c','d','e','f','g','h','i','j',
	'k','l','m','o','p','q','r','s','t','v',
	'w','x','y','z','A','B','C','D','F','G',
	'H','I','J','K','L','M','N','O','P','K',
	'R','S','T','V','W','X','Y','Z');  
     foreach ($carater as $key => $value) {
     	$radom=rand(0,count($carater)-1);
     	$captcha .=$carater[$radom];
     }
	return $captcha;
	}

if (!empty($_SESSION["std"])){
	if(strlen($_SESSION["std"])>0){
			$captcha       =Generecarter(6);
            $PasswordLib   = new PasswordLib\PasswordLib();
            $hash          = $PasswordLib->createPasswordHash($captcha);
    setcookie('captcha',$hash,time()+60*3);
    //Se dibuja los caracteres en el imagen
	$im          = @imagecreate(170, 53) or die("No se inicio la extension GD");
	$color_fondo = imagecolorallocate($im, 255, 255, 255);
	$color_texto = imagecolorallocate($im, 233, 14, 91);
	imagettftext($im,30, 1, 13,40,$color_texto,'NeoPrintM319.otf',$captcha);
	imagepng($im);
	imagedestroy($im);
	}
}



 ?>