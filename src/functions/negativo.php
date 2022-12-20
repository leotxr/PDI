<?php
require_once 'funcoes.php';

$img = $_FILES['image']['tmp_name'];

$im = imagecreatefrombmp($img);
$largura = imagesx($im);
$altura = imagesy($im);



function filtro_negativo($im, $largura, $altura)
{
  for ($x = 0; $x < $largura; $x++) {
    for ($y = 0; $y < $altura; $y++) {
      $rgb = imagecolorat($im, $x, $y);
      //echo "$rgb, "; 
      $nc = rgb_2_nc($rgb);

      $cinza = (256 - 1) - $rgb;

      //$negativo = imagecolorallocate($im, $cinza, $cinza, $cinza);

      imagesetpixel($im, $x, $y, $cinza);
    }
  }
  return true;
}


if (filtro_negativo($im, $largura, $altura)) {  
  header('Content-Type: image/bmp');
  imagebmp($im);
  imagedestroy($im);
} else {
  echo "Nao foi possivel converter";
}
