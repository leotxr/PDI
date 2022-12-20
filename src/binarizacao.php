<?php
require_once 'funcoes.php';

$img = $_FILES['image']['tmp_name'];

$im = imagecreatefromjpeg($img);
$largura = imagesx($im);
$altura = imagesy($im);



function filtro_binario($im, $largura, $altura)
{
  for ($x = 0; $x < $largura; $x++) {
    for ($y = 0; $y < $altura; $y++) {
      $rgb = imagecolorat($im, $x, $y);
      $r = ($rgb >> 16) & 0xFF;
      $g = ($rgb >> 8) & 0xFF;
      $b = $rgb & 0xFF;

      $nc = rgb_2_nc($r, $g, $b);

      if($nc < 256/2)
        $bin = 0;
      else
        $bin = 255;

      imagesetpixel($im, $x, $y, $bin);
    }
  }
  return true;
}


if (filtro_binario($im, $largura, $altura)) {
  header('Content-Type: image/jpg');

  imagejpeg($im);
  imagedestroy($im);
} else {
  echo "Nao foi possivel converter";
}
