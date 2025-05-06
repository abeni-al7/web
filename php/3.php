<?php
// Function to find the greatest element in an array
function findGreatest(array $arr) {
    $max = $arr[0];
    foreach ($arr as $value) {
        if ($value > $max) {
            $max = $value;
        }
    }
    return $max;
}

// Function to find the smallest element in an array
function findSmallest(array $arr) {
    $min = $arr[0];
    foreach ($arr as $value) {
        if ($value < $min) {
            $min = $value;
        }
    }
    return $min;
}

// Sample array
$numbers = [12, 45, 2, 78, 34, 5, 99, 23];

echo "Array: " . implode(", ", $numbers) . PHP_EOL;

greatest: $greatest = findGreatest($numbers);
smallest: $smallest = findSmallest($numbers);

echo "Greatest element: {$greatest}" . PHP_EOL;
echo "Smallest element: {$smallest}" . PHP_EOL;
