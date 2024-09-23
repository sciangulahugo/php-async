<?php

use SciangulaHugo\Closure\ClosureWrapper;

$wrapper = unserialize(base64_decode($argv[1]));
// $closure = $wrapper->getClosure();
$closure = ClosureWrapper::unserialize($wrapper);
call_user_func($closure);
