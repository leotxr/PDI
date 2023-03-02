<?php

include 'upload.php';


function filtros($largura, $altura, $im)
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
            var_dump($exp);
            break;

        case 2: //compressao

            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {

                    $rgb = imagecolorat($im, $x, $y);

                    $comp = ($rgb / $const) - $soma;

                    if ($comp > 255) $comp = 255;

                    if ($comp < 0) $comp = 0;


                    imagesetpixel($im, $x, $y, $comp);
                }
            }
            break;

        default:
            echo "default";
    }
    return true;
}


if (filtros($largura, $altura, $im)) {
    ob_start(); //inicia o buffer
    header('Content-Type: image/bmp');
    imagebmp($im, NULL, false); // gera imagem em bmp sem compressao
    imagebmp($im, '../images/saida/imagem.bmp', false); // salva a img
    imagedestroy($im); //apos gerar a imagem ela eh destruida pois ja esta em buffer
    $i = ob_get_clean(); //limpa o buffer e pega o conteudo
    echo "<img src='data:image/bmp;base64," . base64_encode($i) . "'>";
} else {
    echo "Nao foi possivel converter";
}

