<?php

include 'upload.php';

function rotacoes($image, $largura, $altura, $im)
{
    $option = $_POST['option'];
    switch ($option) {
        case 1: //horario

            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {

                    $ref = imagecolorat($image, $x, $y);
                    #echo "$ref - ";
                    imagesetpixel($im, ($altura - 1) - $y, $x, $ref);
                }
            }
            break;

        case 2: //anti horario

            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {

                    $ref = imagecolorat($image, $x, $y);
                    #echo "$ref - ";
                    imagesetpixel($im, $y, ($altura - 1) - $x, $ref);
                }
            }
            break;

        case 3: //180 graus

            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {

                    $ref = imagecolorat($image, $x, $y);
                    imagesetpixel($im, ($altura - 1) - $x, ($largura - 1) - $y, $ref);
                }
            }
            break;

        case 4: //espelhamento vertical

            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {

                    $ref = imagecolorat($image, $x, $y);
                    imagesetpixel($im, $x, ($largura - 1) - $y, $ref);
                }
            }
            break;

        case 5: //espelhamento horizontal

            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {

                    $ref = imagecolorat($image, $x, $y);
                    imagesetpixel($im, ($largura - 1) - $x, $y, $ref);
                }
            }
            break;

        default:
            echo "default";
    }
    return true;
}


if (rotacoes($image, $largura, $altura, $im)) {
    ob_start(); //inicia o buffer
    header('Content-Type: image/bmp');
    imagebmp($im, NULL, false); // gera imagem em bmp
    imagebmp($im, '../images/saida/rotacao.bmp', false); // salva a img
    imagedestroy($im); //apos gerar a imagem ela eh destruida pois ja esta em buffer
    $i = ob_get_clean(); //limpa o buffer e pega o conteudo
    echo "<img src='data:image/bmp;base64," . base64_encode($i) . "'>";

} else {
    echo "Nao foi possivel converter";
}