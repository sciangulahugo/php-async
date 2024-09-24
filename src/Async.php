<?php

namespace SciangulaHugo\Closure;

use Closure;
use SciangulaHugo\Closure\ClosureWrapper;

/** 
 * Async 
 *  
 * @version 1.0.0
 * @created 2024-09-23 02:02 
 * @updated 2024-09-23 23:06 
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
        $nullDevice = (strncasecmp(PHP_OS, 'WIN', 3) == 0) ? 'NUL' : '/dev/null';

        //TODO: comming son for windows 
        //-RedirectStandardOutput $nullDevice -RedirectStandardError $nullDevice
        $command = (strncasecmp(PHP_OS, 'WIN', 3) == 0)
            ? "powershell -Command \"Start-Process php -ArgumentList '" . __DIR__ . "/execute.php', '" . base64_encode($this->serialized) . "' -WindowStyle Hidden\""
            : "php " . __DIR__ . "/execute.php " . base64_encode($this->serialized) . " > $nullDevice 2>&1 &";

        exec($command);
    }
}
