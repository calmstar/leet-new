<?php
$fileName = $argv[1];
$filePath = __DIR__ . "/$fileName";

echo "debug file: " . $filePath . PHP_EOL;

if (file_exists($filePath)) {
    require_once $filePath;
} else {
    echo 'file not found' . PHP_EOL;
}

