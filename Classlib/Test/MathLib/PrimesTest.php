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
    
    public function testGetNthPrimeReturnTwoForTheFirst()
    {
        $this->assertEquals(2, $this->subject->getTheNthPrime(1));
    }

    public function testGetNthPrimeReturnThreeForTheSecond()
    {
        $this->assertEquals(3, $this->subject->getTheNthPrime(2));
    }
}