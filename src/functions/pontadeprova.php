<?php



$image = $_POST['image'];


$relX = $_POST['relX'];
$relY = $_POST['relY'];


$color = imagecolorat($image, $relX, $relY);

echo "$color";
