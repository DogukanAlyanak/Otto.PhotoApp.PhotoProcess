<?php
if (function_exists('uniqurlid')) {
    return;
}

/* Create Session - Agent ID */
function uniqurlid($lengthMax = 60) {
    if ($lengthMax < 30) { $lengthMax = 30; }
    $lengthMin = $lengthMax - 25;
    $length = rand($lengthMin, $lengthMax);
    $words = ["q", "w", "e", "r", "t", "y", "u", "o", "p", "a", "s", "d", "f", "g", "h", "j", "k", "l", "z", "x", "c", "v", "b", "n", "m", "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "A", "S", "D", "F", "G", "H", "J", "K", "L", "Z", "X", "C", "V", "B", "N", "M", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "-"];
    $i = 1;
    $encword = '';
    while ($i < $length) {
        $countWord = count($words) - 1;
        $encword .= $words[rand(0, $countWord)];
        $i++;
    }
    return $encword;
}
