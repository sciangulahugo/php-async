<?php

use SciangulaHugo\Async\ClosureWrapper;

require_once __DIR__ . "/../vendor/autoload.php";

$wrapper = unserialize(base64_decode($argv[1]));
// $closure = $wrapper->getClosure();
$closure = ClosureWrapper::unserialize($wrapper);
call_user_func($closure);
