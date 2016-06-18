<?php
namespace DevSpace\Factories;

use DevSpace\DI\Container;

class Primes
{
    private static $primesGenerators = array('IncrementalSieve', 'NaivePrimes');
    public static function get($type)
    {
        $container = new Container();
        if (in_array($type, self::$primesGenerators)) {
            return $container->get($type);
        }
        return $container->get('IncrementalSieve');
    }
}