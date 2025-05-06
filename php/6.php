<?php
// Function to find the maximum value in a multi-dimensional array
function findMaxValue(array $arr) {
    $max = null;
    foreach ($arr as $val) {
        if (is_array($val)) {
            $current = findMaxValue($val);
        } else {
            $current = $val;
        }
        if ($max === null || $current > $max) {
            $max = $current;
        }
    }
    return $max;
}

// Sample multi-dimensional array
$multiArray = [
    [3, 5, 1],
    [7, [2, 9], 4],
    6
];

echo "Array: ";
print_r($multiArray);

echo "Maximum value: " . findMaxValue($multiArray) . PHP_EOL;
