<?php
require_once 'funcoes.php';

$img = $_FILES['image']['tmp_name'];
$image = imagecreatefrombmp($img);
$largura = imagesx($image);
$altura = imagesy($image);
$im = imagecreatefrombmp($img);

function ativa_filtro($im, $largura, $altura, $image)
{
    $filter = $_POST['filter'];
    $treshold = $_POST['treshold'];
    switch ($filter) {
        case 1: //laplaciano
            $matriz = array(
                array(0, 1, 0),
                array(1, -4, 1),
                array(0, 1, 0)
            );

            imageconvolution($im, $matriz, 1, 127);
            break;

        case 2: //sobel
            $kx = array(
                array(-1, 0, 1),
                array(-2, 0, 2),
                array(-1, 0, 1)
            );
            $ky = array(
                array(-1, -2, -1),
                array(0, 0, 0),
                array(1, 2, 1)
            );

            //percorre a imagem declarando uma variavel de soma como, para utilizar o sobel
            for ($x = 1; $x < $largura - 1; $x++) {
                for ($y = 1; $y < $altura - 1; $y++) {
                    $xSum = $ySum = 0;
                    //percorre as matrizes de mascara calculando os valores do filtro.
                    for ($i = 0; $i < 3; $i++) {
                        for ($j = 0; $j < 3; $j++) {
                            $gray = imagecolorat($image, $x + $i - 1, $y + $j - 1); //pega a cor do pixel atual

                            $xSum += $gray * $kx[$i][$j]; // soma incrementalmente o valor do NC + variavel de soma
                            // e multiplica pela coordenada atual da matriz kx
                            $ySum += $gray * $ky[$i][$j];
                        }
                    }
                    //calculo a magnitude de cor do pixel
                    $magnitude = sqrt($xSum * $xSum + $ySum * $ySum);

                    //realiza um if ternario para verificar se o NC eh maior que o treshold informado
                    // se for, a cor eh alterada para 255, senao eh alterada para 0 e aplicada na imagem
                    $cor = $magnitude > $treshold ? 255 : 0;
                    // Aplica o filtro sobel no pixel
                    imagesetpixel($im, $x, $y, $cor);
                }
            }
            break;

        case 3: //prewitt
            $kx = array(
                array(-1, 0, 1),
                array(-1, 0, 1),
                array(-1, 0, 1)
            );
            $ky = array(
                array(-1, -1, -1),
                array(0, 0, 0),
                array(1, 1, 1)
            );

            //percorre a imagem declarando uma variavel de soma como, para utilizar o sobel
            for ($x = 1; $x < $largura - 1; $x++) {
                for ($y = 1; $y < $altura - 1; $y++) {
                    $xSum = $ySum = 0;
                    //percorre as matrizes de mascara calculando os valores do filtro.
                    for ($i = 0; $i < 3; $i++) {
                        for ($j = 0; $j < 3; $j++) {
                            $gray = imagecolorat($image, $x + $i - 1, $y + $j - 1); //pega a cor do pixel atual

                            $xSum += $gray * $kx[$i][$j]; // soma incrementalmente o valor do NC + variavel de soma
                            // e multiplica pela coordenada atual da matriz kx
                            $ySum += $gray * $ky[$i][$j];
                        }
                    }
                    //calculo a magnitude de cor do pixel
                    $magnitude = sqrt($xSum * $xSum + $ySum * $ySum);

                    //realiza um if ternario para verificar se o NC eh maior que 100
                    // se for, a cor eh alterada para 255, senao eh alterada para 0 e aplicada na imagem
                    $cor = $magnitude > 100 ? 255 : 0;
                    // Aplica o filtro sobel no pixel
                    imagesetpixel($im, $x, $y, $cor);
                }
            }
            break;



        default:
            echo 'nada';
    }
    return true;
}

if (ativa_filtro($im, $largura, $altura, $image)) {

    ob_start();
    header("Content-type: image/bmp");
    imagebmp($im, NULL, false); // primeiro argumento imagem, segundo nome p salvar arquivo, terceiro compressao 
    imagedestroy($im);
    $i = ob_get_clean();
    echo "<img src='data:image/bmp;base64," . base64_encode($i) . "'>";
} else {
    echo "Nao foi possivel converter";
}
