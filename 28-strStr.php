<?

function strStr2($haystack, $needle) {
    if (empty($needle)) return 0;
    $h = strlen($haystack);
    $n = strlen($needle);
    $count = $h - $n;
    for ($i = 0; $i <= $count; $i++) {
        if ($haystack[$i] == $needle[0] && substr($haystack, $i, $n) == $needle) {
            return $i;
        }
    }
    return -1;
}

$res = strStr2("hello", "ll");
var_dump($res);
