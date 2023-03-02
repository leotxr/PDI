<?php

$img = $_FILES['image']['tmp_name'];
$image = imagecreatefromjpeg($img);
$largura = imagesx($image);
$altura = imagesy($image);


$option = $_REQUEST['option']; //recebe a opcao e trata o tamanho
$filter = $_REQUEST['filter'];

switch ($filter) {

    case 1: //bilinear
        if ($option == '1') {
            $tam = 512;
        } else if ($option == '2') {
            $tam = 1024;
        } else {
            $tam = $altura * 2;
        }

        $rz_altura = $tam / $altura;
        $rz_largura = $tam / $largura;
        $im = imagecreatetruecolor($tam, $tam);


        //cria uma copia da imagem no tamanho original


        for ($i = 0; $i < $tam; $i++) { //altura
            for ($j = 0; $j < $tam; $j++) { //largura

                $x = $j / $rz_largura;
                $y = $i / $rz_altura;

                $x_floor = floor($x);
                $y_floor = floor($y);



                $color = imagecolorat($image, $x_floor, $y_floor);
                imagesetpixel($im, $j, $i, $color);
            }
        }

        break;

    case 2:
        if ($option == '1') {
            $tam = 512;
        } else if ($option == '2') {
            $tam = 1024;
        } else {
            $tam = $altura * 2;
        }

        $rz_altura = $tam / $altura;
        $rz_largura = $tam / $largura;
        $im = imagecreatetruecolor($tam, $tam);

        for ($y = 0; $y < $tam; $y++) {
            for ($x = 0; $x < $tam; $x++) {

                $y_floor = round($y * $altura / $tam);
                if ($y_floor > 255) {
                    $y_floor = 255;
                }

                $x_floor = round($x * $largura / $tam);
                if ($x_floor > 255) {
                    $x_floor = 255;
                }

                $color = imagecolorat($image, $y_floor, $x_floor);
                imagesetpixel($im, $y, $x, $color);
            }
        }

        break;
}




header('Content-Type: image/jpeg');
imagejpeg($im); // gera imagem em jpeg
imagejpeg($im, '../images/saida/resampling.bmp', false); // salva a img
