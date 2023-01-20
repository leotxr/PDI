<?php
require_once 'funcoes.php';

$img = $_FILES['image']['tmp_name'];
$im = imagecreatefrombmp($img);
$largura = imagesx($im);
$altura = imagesy($im);

$filter = $_POST['filter'];
if ($filter)
    echo $filter;
else
    echo 'peguei nada';

    /*
function filtro_binario($im, $largura, $altura)
{
  for ($x = 0; $x < $largura; $x++) {
    for ($y = 0; $y < $altura; $y++) {
      $rgb = imagecolorat($im, $x, $y);
      $r = ($rgb >> 16) & 0xFF;
      $g = ($rgb >> 8) & 0xFF;
      $b = $rgb & 0xFF;

      //$nc = rgb_2_nc($rgb);

      if($rgb < 256/2)
        $bin = 0;
      else
        $bin = 255;

      imagesetpixel($im, $x, $y, $bin);
    }
  }
  return true;
}


if (filtro_binario($im, $largura, $altura)) {
  ob_start(); //inicia o buffer
  //header('Content-Type: image/jpg');
  imagebmp($im); // gera imagem em jpeg
  imagedestroy($im); //apos gerar a imagem ela eh destruida pois ja esta em buffer
  $i = ob_get_clean(); //limpa o buffer e pega o conteudo
  echo "data:image/bmp;base64," . base64_encode( $i ).""; //mostra a imagem

} else {
  echo "Nao foi possivel converter";
}
*/