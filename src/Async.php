<?php

namespace SciangulaHugo\Closure;

use Closure;
use SciangulaHugo\Closure\ClosureWrapper;

/**
 * Async
 * 
 * created at 2024-09-23 02:02
 * updated at 2024-09-23 02:02
 */

class Async
{
    protected $serialized;
    public function create(Closure $closure)
    {
        $wrapper = ClosureWrapper::serialize($closure);
        $this->serialized = serialize($wrapper);
    }

    public function run()
    {
        exec("php " . __DIR__ . "/execute.php " . base64_encode($this->serialized) . " > /dev/null 2>&1 &");
    }
}
