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
    public function testGetNthPrimesReturnsCorrectPrimeNumber($n, $expected)
    {
        $this->assertEquals($expected, $this->subject->getTheNthPrime($n));
    }

    public function TheNthPrimeProvider()
    {
        return array(
            'the 1st prime is 2'      =>  array(1, 2),
            'the 2nd prime is 3'      =>  array(2, 3),
            'the 3rd prime is 5'      =>  array(3, 5),
            'the 4th prime is 7'      =>  array(4, 7),
            'the 5th prime is 11'     =>  array(5, 11),
            'the 6th prime is 13'     =>  array(6, 13),
            'the 10th prime is 29'    =>  array(10, 29),
        );
    }
}