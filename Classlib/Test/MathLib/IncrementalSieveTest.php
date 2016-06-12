<?php
namespace DevSpace\Test\MathLib;

use DevSpace\MathLib\IncrementalSieve;
use DevSpace\Test\Core\TestCase;

class IncrementalSieveTest extends TestCase
{
    /** @var  IncrementalSieve */
    private $subject;

    public function setUp()
    {
        $this->subject = new IncrementalSieve();
    }

    public function testPrimesIsInstanceOfIPrimes()
    {
        $this->assertInstanceOf('DevSpace\Interfaces\MathLib\IPrimes', $this->subject);
    }

    /**
     * @param $n
     * @param $expected
     * @dataProvider TheNthPrimeProvider
     */
    public function testGetNthPrimesReturnsCorrectPrimeNumber($n, $expected)
    {
        $this->assertEquals($expected, max($this->subject->primes($n)));
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
            'the 100th prime is 541'            => array(100, 541),
            'the 1Kth  prime is 7,919'          => array(1e3, 7919),
            'the 10Kth prime is 104,729'        => array(1e4, 104729),
            'the 100Kth prime is 1,299,709'     => array(1e5, 1299709),
//            'the 1Mth prime is 15,485,863'      => array(1e6, 15485863), //takes 15 seconds to run
//            'the 10Mth prime is 179,424,673'    => array(1e7, 179424673) //takes 2.5 minutes to run
        );
    }

    public function testPrimesReturnsNPrimeNumbers()
    {
        $this->assertEquals(
            array(2, 3, 5, 7, 11),
            $this->subject->primes(5)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider InvalidateArgProvider
     */
    public function testPrimesReturnEmptyWithValidateInput($input)
    {
        $this->assertEquals(array(), $this->subject->primes($input));
    }

    public function InvalidateArgProvider()
    {
        return array(
            'Argument null is invalid'      =>  array(null),
            'Argument zero is invalid'      =>  array(0),
            'Argument negatives are invalid'  =>  array(-1),
            'Argument decimals are invalid'   =>  array(3.33),
            'Argument strings are invalid'    =>  array('number')
        );
    }

}