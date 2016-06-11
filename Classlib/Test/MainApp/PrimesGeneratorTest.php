<?php
namespace DevSpace\Test\MainApp;

use DevSpace\MainApp\PrimesGenerator;
use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Test\Core\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class PrimesGeneratorTest extends TestCase
{
    /** @var  PrimesGenerator */
    private $subject;

    /** @var  IMessages | PHPUnit_Framework_MockObject_MockObject */
    private $mockMessages;

    public function setUp() {
        $this->mockMessages = $this->getMock(IMessages::class);
        $this->subject = new PrimesGenerator(
            $this->mockMessages
        );
    }

    public function testRunDisplaysOutputMessagesIfNoArgs()
    {
        $this->expectToGetAMessage('MSG_PRMGEN_INVALID_INPUT');
        $this->subject->run();
    }

    public function expectToGetAMessage($expected)
    {
        $this->mockMessages
            ->expects($this->once())
            ->method('getMessage')
            ->with($expected);
    }

    
}