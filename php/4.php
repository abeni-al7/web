<?php
// Function to check if a string is a palindrome
function isPalindrome(string $str): bool {
    $clean = preg_replace('/[^A-Za-z0-9]/', '', strtolower($str));
    return $clean === strrev($clean);
}

define('STDIN', fopen('php://stdin', 'r'));

echo "Enter a string: ";
$input = trim(fgets(STDIN));

if (isPalindrome($input)) {
    echo "'$input' is a palindrome." . PHP_EOL;
} else {
    echo "'$input' is not a palindrome." . PHP_EOL;
}
