<?php

namespace SciangulaHugo\Closure;

use Closure;
use Opis\Closure\SerializableClosure;

/**
 * ClosureWrapper
 * 
 * created at 2024-09-23 02:02
 * updated at 2024-09-23 02:02
 */
class ClosureWrapper
{
    public static function wrap(Closure $closure)
    {
        // $errorReporting = error_reporting();
        // error_reporting(0);

        $wrapped = new SerializableClosure($closure);

        // error_reporting($errorReporting);

        return $wrapped;
    }

    public static function unwrap($serializedClosure)
    {
        // $errorReporting = error_reporting();
        // error_reporting(0);

        $closure = $serializedClosure->getClosure();

        // error_reporting($errorReporting);

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
