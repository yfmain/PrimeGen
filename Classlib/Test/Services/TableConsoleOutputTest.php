<?php
namespace DevSpace\Test\Services;

use Console_Table;
use DevSpace\Services\TableConsoleOutput;
use DevSpace\Test\Core\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class TableConsoleOutputTest extends TestCase
{

    /** @var  TableConsoleOutput */
    private $subject;

    /** @var  Console_Table| PHPUnit_Framework_MockObject_MockObject */
    private $mockConsoleTable;

    public function setUp()
    {
        $this->mockConsoleTable = $this->getMock(Console_Table::class);
        $this->subject = new TableConsoleOutput($this->mockConsoleTable);
    }

    public function testSubjectIsInstanceOfIConsoleOutput()
    {
        $this->assertInstanceOf('DevSpace\Interfaces\Services\ITableConsoleOutput', $this->subject);
    }

    public function testOutputArrayWillReturnEmptyStringWithEmptyInput()
    {
        $this->assertEquals('', $this->subject->outputArray(array()));
    }

    public function testOutputArrayWillUseConsoleTableReturnExpectedOutput()
    {
        $data = array('k1' => [], 'k2' => []);
        $keys = array('k1', 'k2');
        $expectResult = "this is output result, by Console_Table";
        $this->mockConsoleTable
            ->expects($this->once())
            ->method('setHeaders')
            ->with(array('', 'k1', 'k2'));
        $this->mockConsoleTable
            ->expects($this->once())
            ->method('addCol')
            ->with($keys);
        $this->mockConsoleTable
            ->expects($this->once())
            ->method('addData')
            ->with($keys, 1, 0);
        $this->mockConsoleTable
            ->expects($this->once())
            ->method('getTable')
            ->willReturn($expectResult);
        $this->assertEquals($expectResult, $this->subject->outputArray($data));

    }
}