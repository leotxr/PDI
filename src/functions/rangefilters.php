<?php

$img = $_FILES['image']['tmp_name'];
$im = imagecreatefrombmp($img);
$largura = imagesx($im);
$altura = imagesy($im);


function rotacoes($largura, $altura, $im)
{
    $option = $_POST['option'];
    $const = $_POST['const'];
    $soma = $_POST['soma'];

    switch ($option) {
        case 1: //expansao

            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {

                    $rgb = imagecolorat($im, $x, $y);

                    $exp = $const * $rgb + $soma;

                    if ($exp > 255) $exp = 255;

                    if ($exp < 0) $exp = 0;



                    imagesetpixel($im, $x, $y, $exp);
                }
            }
            break;

        case 2: //compressao

            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {

                    $rgb = imagecolorat($im, $x, $y);

                    $exp = $rgb / $const - $soma;

                    if ($exp > 255) $exp = 255;

                    if ($exp < 0) $exp = 0;



                    imagesetpixel($im, $x, $y, $exp);
                }
            }
            break;

        default:
            echo "default";
    }
    return true;
}


if (rotacoes($largura, $altura, $im)) {
    ob_start(); //inicia o buffer
    header('Content-Type: image/bmp');
    imagebmp($im); // gera imagem em jpeg
    imagedestroy($im); //apos gerar a imagem ela eh destruida pois ja esta em buffer
    $i = ob_get_clean(); //limpa o buffer e pega o conteudo
    echo "data:image/bmp;base64," . base64_encode($i) . ""; //mostra a imagem
} else {
    echo "Nao foi possivel converter";
}
/*
if (rotacoes($image, $largura, $altura, $im)) {
    header('Content-Type: image/jpeg');
    imagejpeg($im); // gera imagem em jpeg
}
*/
