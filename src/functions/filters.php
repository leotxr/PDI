<?php
require_once 'funcoes.php';

$img = $_FILES['image']['tmp_name'];
$im = imagecreatefrombmp($img);
$largura = imagesx($im);
$altura = imagesy($im);


function ativa_filtro($im, $largura, $altura)
{
    $filter = $_POST['filter'];
    switch ($filter) {
        case 1: //negativo
            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {
                    $rgb = imagecolorat($im, $x, $y);

                    //$nc = rgb_2_nc($rgb);

                    $cinza = (256 - 1) - $rgb;

                    $negativo = imagecolorallocate($im, $cinza, $cinza, $cinza);

                    imagesetpixel($im, $x, $y, $cinza);
                }
            }
            break;

        case 2: //binarizacao
            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {
                    $rgb = imagecolorat($im, $x, $y);
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;

                    //$rgb = rgb_2_nc($rgb);

                    if ($rgb < 256 / 2)
                        $bin = 0;
                    else
                        $bin = 255;

                    imagesetpixel($im, $x, $y, $bin);
                }
            }
            break;

        case 3: //espelhamento
            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {
                    //$rgb = imagecolorat($im, $x, $y);
                    //$r = log1p(($rgb >> 16) & 0xFF);
                    //$g = log1p(($rgb >> 8) & 0xFF);
                    //$b = log1p($rgb & 0xFF);

                    //$nc = rgb_2_nc($rgb, $r, $g, $b);

                    //$log = log1p($rgb);
                    //echo $log;
                    //imagecolorallocate($im, $r, $g, $b);
                    //imagesetpixel($im, $x, $y, $log);

                    //$ref = imagecolorat($im, $y, $y);
                    //imagesetpixel($im, ($altura - 1) - $y, $x, $ref);
                    //return imagerotate($im, 270, 0);
                }
            }
            break;


        default:
            echo 'nada';
    }
    return true;
}

if (ativa_filtro($im, $largura, $altura)) {
    ob_start(); //inicia o buffer
    header('Content-Type: image/bmp');
    imagebmp($im); // gera imagem em jpeg
    imagedestroy($im); //apos gerar a imagem ela eh destruida pois ja esta em buffer
    $i = ob_get_clean(); //limpa o buffer e pega o conteudo
    echo "data:image/bmp;base64," . base64_encode($i) . ""; //mostra a imagem

} else {
    echo "Nao foi possivel converter";
}
