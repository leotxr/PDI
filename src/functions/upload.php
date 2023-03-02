<?php
$img = $_FILES['image']['tmp_name'];
$image = imagecreatefrombmp($img);
$largura = imagesx($image);
$altura = imagesy($image);
$im = imagecreatefrombmp($img);