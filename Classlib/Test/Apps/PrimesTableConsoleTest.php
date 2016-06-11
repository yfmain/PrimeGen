<?php
namespace DevSpace\Test\Apps;

use DevSpace\Apps\PrimesTableConsole;
use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Interfaces\Validators\INaturalNumber;
use DevSpace\Interfaces\Services\IOutput;
use DevSpace\Test\Core\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class PrimesTableConsoleTest extends TestCase
{
    /** @var  PrimesTableConsole */
    private $subject;

    /** @var  IMessages | PHPUnit_Framework_MockObject_MockObject */
    private $mockMessages;

    /** @var  INaturalNumber | PHPUnit_Framework_MockObject_MockObject */
    private $mockSizeValidator;

    /** @var  IOutput | PHPUnit_Framework_MockObject_MockObject */
    private $mockOutputService;

    public function setUp()
    {
        $this->mockMessages = $this->getMock(IMessages::class);
        $this->mockSizeValidator = $this->getMock(INaturalNumber::class);
        $this->mockOutputService = $this->getMock(IOutput::class);
        $this->subject = new PrimesTableConsole(
            $this->mockMessages,
            $this->mockSizeValidator,
            $this->mockOutputService
        );
    }

    public function testRunDisplaysOutputMessagesIfSizeArgInValid()
    {
        $expectedResult = 'Help';
        $this->expectSizeArgValidated(false);
        $this->expectToGetAMessage('MSG_PRMGEN_INVALID_INPUT', $expectedResult);
        $this->expectConsoleToDisplayMessage($expectedResult);
        $this->subject->run(-1);
    }

    private function expectConsoleToDisplayMessage($arg)
    {
        $this->mockOutputService
            ->expects($this->once())
            ->method('display')
            ->with();
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