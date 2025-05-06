<?php
define('STDIN', fopen('php://stdin', 'r'));
echo "Enter number of lines: ";
$n = intval(trim(fgets(STDIN)));
$num = 1;
for ($i = 1; $i <= $n; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $num;
        if ($j < $i) echo ' ';
        $num++;
    }
    echo PHP_EOL;
}