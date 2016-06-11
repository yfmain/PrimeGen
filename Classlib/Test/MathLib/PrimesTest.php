<?php
namespace DevSpace\Test\MathLib;

use DevSpace\MathLib\Primes;
use DevSpace\Test\Core\TestCase;

class PrimesTest extends TestCase
{
    /** @var  Primes */
    private $subject;
    
    public function setUp()
    {
        $this->subject = new Primes();
    }

    /**
     * @param $n
     * @param $expected
     * @dataProvider TheNthPrimeProvider
     */
    public function testGetNthePrimesReturnsCorrectPrimeNumber($n, $expected)
    {
        $this->assertEquals($expected, $this->subject->getTheNthPrime($n));
    }

    public function TheNthPrimeProvider()
    {
        return array(
            'the 1st prime is 2'      =>  array(1, 2),
            'the 2nd prime is 3 '      =>  array(2, 3),
        );
    }
}