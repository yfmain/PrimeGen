<?php
namespace DevSpace\Test\Apps;

use DevSpace\Apps\PrimesTableConsole;
use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Interfaces\Validators\INaturalNumber;
use DevSpace\Interfaces\Services\IConsole;
use DevSpace\Interfaces\Services\IPrimesTable;
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

    /** @var  IConsole | PHPUnit_Framework_MockObject_MockObject */
    private $mockOutputService;

    /** @var  IPrimesTable | PHPUnit_Framework_MockObject_MockObject */
    private $mockPrimesTableService;

    public function setUp()
    {
        $this->mockMessages = $this->getMock(IMessages::class);
        $this->mockSizeValidator = $this->getMock(INaturalNumber::class);
        $this->mockOutputService = $this->getMock(IConsole::class);
        $this->mockPrimesTableService = $this->getMock(IPrimesTable::class);
        $this->subject = new PrimesTableConsole(
            $this->mockMessages,
            $this->mockSizeValidator,
            $this->mockOutputService,
            $this->mockPrimesTableService
        );
    }

    public function testRunDisplaysOutputMessagesIfSizeArgInValid()
    {
        $size = -1;
        $expectedResult = 'Help';
        $msgType = 'MSG_PRMGEN_INVALID_INPUT';
        $this->expectSizeArgValidated($size, false);
        $this->expectToGetAMessage($msgType, $expectedResult);
        $this->expectConsoleToDisplayMessage($expectedResult);
        $this->subject->run($size);
    }

    public function testRunDisplaysResultsIfSizeArgIsValid()
    {
        $size = 3;
        $expectedResult = array('i am a result table');
        $this->expectSizeArgValidated($size, true);
        $this->expectToGetPrimesTable($size, $expectedResult);
        $this->expectConsoleToDisplayResult($expectedResult);
        $this->subject->run($size);
    }

    private function expectToGetPrimesTable($arg, $result)
    {
        $this->mockPrimesTableService
            ->expects($this->once())
            ->method('getPrimesTable')
            ->with($arg)
            ->willReturn($result);
    }

    private function expectConsoleToDisplayResult($arg)
    {
        $this->mockOutputService
            ->expects($this->once())
            ->method('displayArray')
            ->with($arg);
    }

    private function expectConsoleToDisplayMessage($arg)
    {
        $this->mockOutputService
            ->expects($this->once())
            ->method('display')
            ->with($arg);
    }

    private function expectSizeArgValidated($arg, $expected)
    {
        $this->mockSizeValidator
            ->expects($this->once())
            ->method('validate')
            ->with($arg)
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