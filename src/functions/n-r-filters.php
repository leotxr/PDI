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
    switch ($filter) {

        case 1: //max

            for ($x = 1; $x < $largura - 1; $x++) {
                for ($y = 1; $y < $altura - 1; $y++) {

                    $values = array();
                    for ($i = -1; $i <= 1; $i++) {
                        for ($j = -1; $j <= 1; $j++) {
                            $rgb = imagecolorat($image, $x + $i, $y + $j);
                            $values[] = $rgb;
                        }
                    }
                    $max = max($values);
                    imagesetpixel($im, $x, $y, $max);
                }
            }
            break;

        case 2: //min

            for ($x = 1; $x < $largura - 1; $x++) {
                for ($y = 1; $y < $altura - 1; $y++) {

                    $values = array();
                    for ($i = -1; $i <= 1; $i++) {
                        for ($j = -1; $j <= 1; $j++) {
                            $rgb = imagecolorat($image, $x + $i, $y + $j);
                            $values[] = $rgb;
                        }
                    }
                    $min = min($values);
                    imagesetpixel($im, $x, $y, $min);
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
