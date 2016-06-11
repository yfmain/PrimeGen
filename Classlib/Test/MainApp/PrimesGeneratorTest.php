<?php
namespace DevSpace\Test\MainApp;

use DevSpace\MainApp\PrimesGenerator;
use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Interfaces\Validators\INaturalNumber;
use DevSpace\Interfaces\MathLib\IPrimes;
use DevSpace\Interfaces\MathLib\ITimesTable;
use DevSpace\Test\Core\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class PrimesGeneratorTest extends TestCase
{
    /** @var  PrimesGenerator */
    private $subject;

    /** @var  IMessages | PHPUnit_Framework_MockObject_MockObject */
    private $mockMessages;

    /** @var  INaturalNumber | PHPUnit_Framework_MockObject_MockObject */
    private $mockSizeValidator;

    /** @var  IPrimes | PHPUnit_Framework_MockObject_MockObject */
    private $mockPrimesGenerator;

    /** @var  ITimesTable | PHPUnit_Framework_MockObject_MockObject */
    private $mockTimesTableGenerator;

    public function setUp() {
        $this->mockMessages = $this->getMock(IMessages::class);
        $this->mockSizeValidator = $this->getMock(INaturalNumber::class);
        $this->mockPrimesGenerator = $this->getMock(IPrimes::class);
        $this->mockTimesTableGenerator = $this->getMock(ITimesTable::class);
        $this->subject = new PrimesGenerator(
            $this->mockMessages,
            $this->mockSizeValidator,
            $this->mockPrimesGenerator,
            $this->mockTimesTableGenerator
        );
    }

    public function testRunDisplaysOutputMessagesIfSizeArgInValid()
    {
        $expectedResult = 'Help';
        $this->expectSizeArgValidated(false);
        $this->expectToGetAMessage('MSG_PRMGEN_INVALID_INPUT', $expectedResult);
        $this->assertEquals($expectedResult, $this->subject->run(-1));
    }

    public function testRunWillGeneratePrimes()
    {
        $primes = array('i am a fake array of n prime numbers');
        $timesTable = array('i am a times table of given primes');
        $size = 4;
        $this->expectSizeArgValidated(true);
        $this->expectGeneratingPrimes($size, $primes);
        $this->expectToGetTimesTableOfPrimes($primes, $timesTable);
        $this->assertEquals($timesTable, $this->subject->run($size));
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

    private function expectSizeArgValidated($expected)
    {
        $this->mockSizeValidator
            ->expects($this->once())
            ->method('validate')
            ->withAnyParameters()
            ->willReturn($expected);
    }

    public function expectToGetAMessage($expectedArg, $expectedMessage)
    {
        $this->mockMessages
            ->expects($this->once())
            ->method('getMessage')
            ->with($expectedArg)
            ->willReturn($expectedMessage);
    }
}