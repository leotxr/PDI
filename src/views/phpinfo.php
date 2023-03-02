
<!DOCTYPE html>
<html>
<body>

<?php
function divide_array_into_subsets($array) {
    // Check if the input array has exactly 9 elements

    
    // Initialize an empty array to hold the subsets
    $subsets = array();
    $min = array();
    $array = array_values($array); 
    
    // Divide the shuffled array into 5 subsets of 5 elements each
    for ($i = 0; $i < 5; $i++) {
        $subsets[] = array_slice($array, $i, 5, false);  
    }
     
    $min = min($subsets);
    $max = max($min);
    
    // Return the array of subsets
    return $min;
}
function divide_array_into_subsets2($array) {
    // Check if the input array has exactly 9 elements

    
    // Initialize an empty array to hold the subsets
    $subsets = array();
    $max = array();
    $array = array_values($array); 
    
    // Divide the shuffled array into 5 subsets of 5 elements each
    for ($i = 0; $i < 5; $i++) {
        $max[] = max($subsets[] = array_slice($array, $i, 5, false));   
    }
     
    //$min = min($subsets);
    $min = min($max);
    
    // Return the array of subsets
    return $min;
}

$array = array(163, 0, 162, 161, 163, 164, 163, 163, 163);
$max = divide_array_into_subsets($array);
$min = divide_array_into_subsets2($array);
print_r($max);

?>

</body>
</html>