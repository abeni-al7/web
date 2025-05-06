<?php

define('STDIN', fopen('php://stdin', 'r'));
function findThirdSide($a, $b) {
    return sqrt(pow($a, 2) + pow($b, 2));
}

echo "Enter length of first side: ";
$side1 = trim(fgets(STDIN));
echo "Enter length of second side: ";
$side2 = trim(fgets(STDIN));

$hypotenuse = findThirdSide((float)$side1, (float)$side2);
echo "Length of the hypotenuse: " . $hypotenuse . PHP_EOL;
