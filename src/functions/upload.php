
<?php
function upload($img)
{
$im = imagecreatefrombmp($img);
$largura = imagesx($im);
$altura = imagesy($im);
}

