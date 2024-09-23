<?php

$possibleAutoloadPaths = [
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../autoload.php',
    __DIR__ . '/../../../autoload.php',
];

foreach ($possibleAutoloadPaths as $file) {
    if (file_exists($file)) {
        require $file;
        break;
    }
}

if (!class_exists('SciangulaHugo\Closure\ClosureWrapper')) {
    throw new RuntimeException('Could not load the autoloader. Make sure the library is installed correctly.');
}

if (isset($argv[1])) {
    $wrapper = unserialize(base64_decode($argv[1]));
    $closure = \SciangulaHugo\Closure\ClosureWrapper::unserialize($wrapper);
    call_user_func($closure);
}
