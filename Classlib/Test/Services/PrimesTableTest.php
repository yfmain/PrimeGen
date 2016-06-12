<?php
namespace DevSpace\Test\Services;

use DevSpace\Services\PrimesTable;
use DevSpace\Interfaces\MathLib\IPrimes;
use DevSpace\Interfaces\MathLib\ITimesTable;
use DevSpace\Test\Core\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class PrimesTableTest extends TestCase
{
    /** @var  PrimesTable */
    private $subject;

    /** @var  IPrimes | PHPUnit_Framework_MockObject_MockObject */
    private $mockPrimesGenerator;

    /** @var  ITimesTable | PHPUnit_Framework_MockObject_MockObject */
    private $mockTimesTableGenerator;

    public function setUp() {
        $this->mockPrimesGenerator = $this->getMock(IPrimes::class);
        $this->mockTimesTableGenerator = $this->getMock(ITimesTable::class);
        $this->subject = new PrimesTable(
            $this->mockPrimesGenerator,
            $this->mockTimesTableGenerator
        );
    }

    public function testSubjectIsInstanceOfIPrimesTable()
    {
        $this->assertInstanceOf('DevSpace\Interfaces\Services\IPrimesTable', $this->subject);
    }

    public function testGetPrimesTableWillGeneratePrimes()
    {
        $primes = array('i am a fake array of n prime numbers');
        $timesTable = array('i am a times table of given primes');
        $size = 4;
        $this->expectGeneratingPrimes($size, $primes);
        $this->expectToGetTimesTableOfPrimes($primes, $timesTable);
        $this->assertEquals($timesTable, $this->subject->getPrimesTable($size));
    }

    private function expectToGetTimesTableOfPrimes($arg, $result)
    {
        $this->mockTimesTableGenerator
            ->expects($this->once())
            ->method('getTable')
            ->with($arg)
            ->willReturn($result);
    }

    private function expectGeneratingPrimes($arg, $result)
    {
        $this->mockPrimesGenerator
            ->expects($this->once())
            ->method('primes')
            ->with($arg)
            ->willReturn($result);
    }
}