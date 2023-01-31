<?php
function rgb_2_nc($rgb)
{
    $r = ($rgb >> 5) & 0xFF;
    $g = ($rgb >> 3) & 0xFF;
    $b = $rgb & 0xFF;
    $nc = ($r + $g + $b) / 3;


    return $nc;
}
