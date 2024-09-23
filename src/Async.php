<?php

namespace SciangulaHugo\Async;

use Closure;
use SciangulaHugo\Async\ClosureWrapper;

/**
 * Async
 * 
 * @author Sciangula Hugo
 * 
 * created 2024-09-23 02:02
 * updated 2024-09-23 02:02
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
