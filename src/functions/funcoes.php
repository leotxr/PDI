<?php
function rgb_2_nc($rgb)
{
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;
    $nc = ($r + $g + $b) / 3;

    return $nc;
}
