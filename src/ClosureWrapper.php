<?php

namespace SciangulaHugo\Closure;

use Closure;
use Opis\Closure\SerializableClosure;

/**
 * ClosureWrapper
 * 
 * @version 1.0.0
 * @created 2024-09-23 02:02
 * @updated 2024-09-23 23:08
 */

class ClosureWrapper
{
    public static function wrap(Closure $closure)
    {
        $wrapped = new SerializableClosure($closure);
        return $wrapped;
    }

    public static function unwrap($serializedClosure)
    {
        $closure = $serializedClosure->getClosure();
        return $closure;
    }

    public static function serialize($closure)
    {
        $errorReporting = error_reporting();
        error_reporting(0);

        $serialized = serialize(self::wrap($closure));

        error_reporting($errorReporting);

        return $serialized;
    }

    public static function unserialize($serialized)
    {
        $errorReporting = error_reporting();
        error_reporting(0);

        $unserialized = self::unwrap(unserialize($serialized));

        error_reporting($errorReporting);

        return $unserialized;
    }
}
