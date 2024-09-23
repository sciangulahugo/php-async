<?php

$autoload = "/autoload.php";

if (file_exists(dirname(__DIR__, 1) . "/vendor/" . $autoload)) {
    require_once dirname(__DIR__, 1) . "/vendor/" . $autoload;
} else if (file_exists(dirname(__DIR__, 3) . $autoload)) {
    require_once dirname(__DIR__, 3) . $autoload;
}

if (isset($argv[1])) {
    $wrapper = unserialize(base64_decode($argv[1]));
    $closure = \SciangulaHugo\Closure\ClosureWrapper::unserialize($wrapper);
    call_user_func($closure);
}
