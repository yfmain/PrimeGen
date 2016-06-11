<?php
namespace DevSpace\Test\MainApp;

use DevSpace\MainApp\PrimesGenerator;
use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Interfaces\Validators\INaturalNumber;
use DevSpace\Interfaces\MathLib\IPrimes;
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
    private $mockPrimes;

    public function setUp() {
        $this->mockMessages = $this->getMock(IMessages::class);
        $this->mockSizeValidator = $this->getMock(INaturalNumber::class);
        $this->mockPrimes = $this->getMock(IPrimes::class);
        $this->subject = new PrimesGenerator(
            $this->mockMessages,
            $this->mockSizeValidator,
            $this->mockPrimes
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
        $expectedResult = array('i am a fake array of n prime numbers');
        $size = 4;
        $this->expectSizeArgValidated(true);
        $this->expectGeneratingPrimes($size, $expectedResult);
        $this->assertEquals($expectedResult, $this->subject->run($size));
    }

    private function expectGeneratingPrimes($arg, $result)
    {
        $this->mockPrimes
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