<?php
require_once 'upload.php';


function ativa_filtro($im, $largura, $altura)
{
    $filter = $_POST['filter'];
    switch ($filter) {
        case 1: //negativo
            for ($x = 0; $x < intval($largura); $x++) {
                for ($y = 0; $y < intval($altura); $y++) {
                    $rgb = imagecolorat($im, $x, $y);
                    //$nc = rgb_2_nc($rgb);

                    $cinza = (256 - 1) - $rgb;

                    //$negativo = imagecolorallocate($im, $cinza, $cinza, $cinza);
                    //echo "$cinza - ";
                   
                    imagesetpixel($im, $x, $y, $cinza);
                    
                }
                
            }
            break;

        case 2: //binarizacao
            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {
                    $rgb = imagecolorat($im, $x, $y);
                    //$r = ($rgb >> 16) & 0xFF;
                    //$g = ($rgb >> 8) & 0xFF;
                    //$b = $rgb & 0xFF;

                    //$rgb = rgb_2_nc($rgb);

                    if ($rgb < 256 / 2)
                        $bin = 0;
                    else
                        $bin = 255;

                    imagesetpixel($im, $x, $y, $bin);
                }
            }
            break;

        case 3: //log
            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {
                    $rgb = imagecolorat($im, $x, $y);
                    //$r = ($rgb >> 16) & 0xFF;
                    //$g = ($rgb >> 8) & 0xFF;
                    //$b = $rgb & 0xFF;

                    //$r = log(1 + $r);
                    //$g = log(1 + $g);
                    $rgb = log(1 + $rgb);

                    //$r = intval($r / log(256) * 255);
                    //$g = intval($g / log(256) * 255);
                    $rgb = intval($rgb / log(256) * 255);

                    //$nc = rgb_2_nc($rgb, $r, $g, $b);

                    //$log = imagecolorallocate($im, $r, $g, $b);
                    imagesetpixel($im, $x, $y, $rgb);
                }
            }
            break;

        case 4: //log invertido
            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {
                    $rgb = imagecolorat($im, $x, $y);
                    //$r = ($rgb >> 16) & 0xFF;
                    //$g = ($rgb >> 8) & 0xFF;
                    //$b = $rgb & 0xFF;

                    //$r = exp($r / 255 * log(256)) - 1;
                    //$g = exp($g / 255 * log(256)) - 1;
                    $rgb = exp($rgb / 255 * log(256)) - 1;

                    $rgb = intval($rgb);

                    //$nc = rgb_2_nc($rgb, $r, $g, $b);

                    //$log = imagecolorallocate($im, $r, $g, $b);
                    imagesetpixel($im, $x, $y, $rgb);
                }
            }
            break;

        case 5: //raiz
            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {
                    $rgb = imagecolorat($im, $x, $y); //pega o valor de NC do pixel

                    $rgb = sqrt($rgb); //faz a raiz quadrada do valor do NC

                    $rgb = intval($rgb / sqrt(256) * 255); // 

                    //$nc = rgb_2_nc($rgb, $r, $g, $b);

                    //$log = imagecolorallocate($im, $r, $g, $b);
                    imagesetpixel($im, $x, $y, $rgb);
                }
            }
            break;

        case 6: //potencia
            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {
                    $rgb = imagecolorat($im, $x, $y);
                    //$r = ($rgb >> 16) & 0xFF;
                    //$g = ($rgb >> 8) & 0xFF;
                    //$b = $rgb & 0xFF;

                    //$r = exp($r / 255 * log(256)) - 1;
                    //$g = exp($g / 255 * log(256)) - 1;
                    $rgb = pow($rgb / 255, 4) * 255; //elevado a 4

                    $rgb = intval($rgb);

                    //$nc = rgb_2_nc($rgb, $r, $g, $b);

                    //$log = imagecolorallocate($im, $r, $g, $b);
                    imagesetpixel($im, $x, $y, $rgb);
                }
            }
            break;


        default:
            echo 'nada';
    }
    return true;
}

if (ativa_filtro($im, $largura, $altura)) {

    ob_start();
    header( "Content-type: image/bmp" );
    imagebmp( $im, NULL, false); // primeiro argumento imagem, segundo nome p salvar arquivo, terceiro compressao 
    imagedestroy( $im );
    $i = ob_get_clean();
    echo "<img src='data:image/bmp;base64," . base64_encode( $i )."'>";

} else {
    echo "Nao foi possivel converter";
}
