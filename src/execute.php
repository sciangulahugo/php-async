<?php

$autoload = "/vendor/autoload.php";

if (file_exists(dirname(__DIR__, 1) . $autoload)) {
    require_once dirname(__DIR__, 1) . $autoload;
} else if (file_exists(dirname(__DIR__, 3) . $autoload)) {
    require_once dirname(__DIR__, 3) . $autoload;
}

if (isset($argv[1])) {
    $wrapper = unserialize(base64_decode($argv[1]));
    // $closure = $wrapper->getClosure();
    $closure = \SciangulaHugo\Closure\ClosureWrapper::unserialize($wrapper);
    call_user_func($closure);
}
