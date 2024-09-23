<?php

namespace SciangulaHugo\Async;

use Opis\Closure\SerializableClosure;

/**
 * ClosureWrapper
 * 
 * @author Sciangula Hugo
 * 
 * created 2024-09-23 02:02
 * updated 2024-09-23 02:02
 */
class ClosureWrapper
{
    public static function wrap(\Closure $closure)
    {
        $errorReporting = error_reporting();
        error_reporting(0);

        $wrapped = new SerializableClosure($closure);

        error_reporting($errorReporting);

        return $wrapped;
    }

    public static function unwrap($serializedClosure)
    {
        $errorReporting = error_reporting();
        error_reporting(0);

        $closure = $serializedClosure->getClosure();

        error_reporting($errorReporting);

        return $closure;
    }

    public static function serialize($closure)
    {
        $serialized = serialize(self::wrap($closure));
        return $serialized;
    }

    public static function unserialize($serialized)
    {
        $unserialized = self::unwrap(unserialize($serialized));
        return $unserialized;
    }
}
