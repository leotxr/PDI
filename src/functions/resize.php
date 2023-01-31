<?php

$img = $_FILES['image']['tmp_name'];
$image = imagecreatefromjpeg($img);
$largura = imagesx($image);
$altura = imagesy($image);
$rz_altura = 1024 / $altura;
$rz_largura = 1024 / $largura;
$im = imagecreatetruecolor(1024, 1024);


//cria uma copia da imagem no tamanho original

$option = 1;
switch ($option) {
    case 1:
        for ($i = 0; $i < 1024; $i++) {
            for ($j = 0; $j < 1024; $j++) {

                $x = $j / $rz_largura;
                $y = $i / $rz_altura;

                $x_floor = floor($x);
                $y_floor = floor($y);



                $color = imagecolorat($image, $x_floor, $y_floor);
                imagesetpixel($im, $j, $i, $color);
            }
        }
        break;

    default:
        echo "default";

    
}

header('Content-Type: image/jpeg');
imagejpeg($im); // gera imagem em jpeg
