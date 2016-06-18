<?php
namespace DevSpace\Test\Factories;

use DevSpace\Factories\Primes;
use DevSpace\Test\Core\TestCase;

class PrimesTest extends TestCase
{
    /**
     * @param string $generatorType
     * @param string $expectedClassType
     * @dataProvider  FactoryArgsProvider
     */
    public function testGetReturnsCorrectInstance($generatorType, $expectedClassType)
    {
        $this->assertInstanceOf($expectedClassType, Primes::get($generatorType));
    }

    public function FactoryArgsProvider()
    {
        $namespace = 'DevSpace\MathLib\\';
        return array(
            'given "IncrementalSieve" will return "IncrementalSieve"' =>
                array('IncrementalSieve', $namespace . 'IncrementalSieve'),
            'given "NaivePrimes" will return "NaivePrimes"' =>
                array('NaivePrimes', $namespace . 'NaivePrimes'),
            'given invalid type will return "IncrementalSieve" as default' =>
                array('Naive Primes', $namespace . 'IncrementalSieve'),
        );
    }
}