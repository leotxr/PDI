<?php
require_once 'funcoes.php';

$img1 = $_FILES['image']['tmp_name'];
$img2 = $_FILES['image2']['tmp_name'];

$im1 = imagecreatefrombmp($img1);
$im2 = imagecreatefrombmp($img2);

$largura1 = imagesx($im1);
$altura1 = imagesy($im1);

$largura2 = imagesx($im2);
$altura2 = imagesy($im2);

$altura = max($altura1, $altura2); // gera altura para imagem de destino com o maximo das dimensoes das duas imagens
$largura = max($largura1, $largura2); // gera largura para imagem de destino com o maximo das dimensoes das duas imagens

$result = imagecreatefrombmp($img1); //cria imagem identica a primeira imagem para processamento

imagecopy($result, $im1, 0, 0, 0, 0, $largura1, $altura1); //cria uma copia da imagem processada para ser alterada

function ativa_filtro($im1, $im2, $largura, $altura, $result)
{
    $option = $_POST['option'];
    $soma1 = $_POST['soma1']; // valor de porcentagem de soma das imagens
    $soma2 = $_POST['soma2'];
    switch ($option) {
        case 1: //adicao
            for ($x = 0; $x < $largura; $x++) {
                for ($y = 0; $y < $altura; $y++) {

                    $rgb1 = imagecolorat($im1, $x, $y); 
                    $rgb1 = $rgb1 * $soma1; //multiplica a cor do pixel pela porcentagem recebida

                    $rgb2 = imagecolorat($im2, $x, $y);
                    $rgb2 = $rgb2 * $soma2;


                    $rgb = min(255, $rgb1 + $rgb2); //soma os dois valores no maximo ate 255


                    imagesetpixel($result, $x, $y, $rgb); // atribui o valor ao pixel
                }
            }
            break;


        default:
            echo 'nada';
    }
    return true;
}

if (ativa_filtro($im1, $im2, $largura, $altura, $result)) {

    ob_start();
    header("Content-type: image/bmp");
    imagebmp($result, NULL, false); // primeiro argumento imagem, segundo nome p salvar arquivo, terceiro compressao 
    imagedestroy($result);
    $i = ob_get_clean();
    echo "<img src='data:image/bmp;base64," . base64_encode($i) . "'>";
} else {
    echo "Nao foi possivel converter";
}
