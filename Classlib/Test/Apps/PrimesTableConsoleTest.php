<?php
namespace DevSpace\Test\Apps;

use DevSpace\Apps\PrimesTableConsole;
use DevSpace\Resources\Messages;
use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Interfaces\Validators\INaturalNumber;
use DevSpace\Interfaces\Services\ITableConsoleOutput;
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

    /** @var  ITableConsoleOutput | PHPUnit_Framework_MockObject_MockObject */
    private $mockOutputService;

    /** @var  IPrimesTable | PHPUnit_Framework_MockObject_MockObject */
    private $mockPrimesTableService;

    public function setUp()
    {
        $this->mockMessages = $this->getMock(IMessages::class);
        $this->mockSizeValidator = $this->getMock(INaturalNumber::class);
        $this->mockOutputService = $this->getMock(ITableConsoleOutput::class);
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
        $msgType = Messages::MSG_PRIMES_TABLE_CONSOLE_HELP;
        $this->expectSizeArgValidated($size, false);
        $this->expectToGetAMessage($msgType, $expectedResult);
        $this->assertEquals($expectedResult, $this->subject->run($size));
    }

    public function testRunDisplaysResultsIfSizeArgIsValid()
    {
        $size = 3;
        $primesTable = array('i am a result table');
        $expectedResult = array('i am an output string');
        $this->expectSizeArgValidated($size, true);
        $this->expectToGetPrimesTable($size, $primesTable);
        $this->expectConsoleToDisplayResult($primesTable, $expectedResult);
        $this->assertEquals($expectedResult, $this->subject->run($size));
    }

    private function expectToGetPrimesTable($arg, $result)
    {
        $this->mockPrimesTableService
            ->expects($this->once())
            ->method('getPrimesTable')
            ->with($arg)
            ->willReturn($result);
    }

    private function expectConsoleToDisplayResult($arg, $result)
    {
        $this->mockOutputService
            ->expects($this->once())
            ->method('outputArray')
            ->with($arg)
            ->willReturn($result);
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