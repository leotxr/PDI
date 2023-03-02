<?php
include 'upload.php';


function getModa($values)
{
    $array = array_count_values($values); //retorna um novo array com todos elementos contaveis ignorando nulos
    $mode = array_search(max($array), $array);
    //array_search possui 3 parametros, o terceiro automaticamente eh TRUE
    //significa que ele procura valores identicos dentro do array
    //caso o array seja bimodal ou adiante, ele pega o maior deles usando max passado no primeiro parametro
    return $mode;
}

function getMaxDosMin($values)
{

    $subsets = array();
    $min = array();
    $array = array_values($values); 
    
    // Divide the shuffled array into 5 subsets of 5 elements each
    for ($i = 0; $i < 5; $i++) {
        $min[] = min($subsets[] = array_slice($array, $i, 5, false));   
    }
     
    //$min = min($subsets);
    $maxDosMin = max($min);
    
    // Return the array of subsets
    return $maxDosMin;
}

function getMinDosMax($values)
{

    $subsets = array();
    $max = array();
    $array = array_values($values); 
    
    // Divide the shuffled array into 5 subsets of 5 elements each
    for ($i = 0; $i < 5; $i++) {
        $max[] = max($subsets[] = array_slice($array, $i, 5, false));   
    }
     
    //$min = min($subsets);
    $minDosMax = min($max);
    
    // Return the array of subsets
    return $minDosMax;
}

function getMediana($values)
{
    $array = array_count_values($values);
    $tamanho = count($array);
    $meio = count($array) / 2;

    if($tamanho % 2 != 0)
    {
        $mediana = $array[$meio];
    }else
    {
        $med1 = $array[$meio];
        $med2 = $array[$meio-1];
        $mediana = ($med1 + $med2) /2;
    }
    return $mediana;
}

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

        case 3: //moda

            for ($x = 1; $x < $largura - 1; $x++) {
                for ($y = 1; $y < $altura - 1; $y++) {

                    $values = array();
                    for ($i = -1; $i <= 1; $i++) {
                        for ($j = -1; $j <= 1; $j++) {
                            $rgb = imagecolorat($image, $x + $i, $y + $j);
                            $values[] = $rgb;
                        }
                    }
                    $moda = getModa($values); //executa a funcao getmoda
                    imagesetpixel($im, $x, $y, $moda);
                }
                //var_dump($values);
                //var_dump($moda);
            }
            break;

        case 4: //pseudomediana

            for ($x = 1; $x < $largura/4 - 1; $x++) {
                for ($y = 1; $y < $altura/4 - 1; $y++) {

                    $values = array();
                    for ($i = -1; $i <= 1; $i++) {
                        for ($j = -1; $j <= 1; $j++) {
                            $rgb = imagecolorat($image, $x + $i, $y + $j);
                            $values[] = $rgb;
                        }
                    }
                    $minDosMax = getMinDosMax($values);
                    $maxDosMin = getMaxDosMin($values);

                    $pseudomed = intval(($minDosMax + $maxDosMin) / 2);

                    imagesetpixel($im, $x, $y, intval($pseudomed));
                }
                //var_dump($x, $y, $pseudomed);
                //var_dump($moda);
            }
            break;

        case 5: //mediana para teste

            for ($x = 1; $x < $largura/4 - 1; $x++) {
                for ($y = 1; $y < $altura/4 - 1; $y++) {

                    $values = array();
                    for ($i = -1; $i <= 1; $i++) {
                        for ($j = -1; $j <= 1; $j++) {
                            $rgb = imagecolorat($image, $x + $i, $y + $j);
                            $values[] = $rgb;
                        }
                    }
                    $mediana = getMediana($values);

                    imagesetpixel($im, $x, $y, intval($mediana));
                }
                //var_dump($x, $y, $pseudomed);
                //var_dump($moda);
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
