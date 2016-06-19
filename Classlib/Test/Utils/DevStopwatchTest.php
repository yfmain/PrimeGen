<?php
namespace DevSpace\Test\Utils;

use DevSpace\Utils\DevStopWatch;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Stopwatch\StopwatchEvent;
use DevSpace\Test\Core\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class DevStopwatchTest extends TestCase
{
    /** @var DevStopWatch */
    private $subject;

    /** @var  StopwatchEvent | PHPUnit_Framework_MockObject_MockObject */
    private $stopwatchEvent;
    /** @var  Stopwatch | PHPUnit_Framework_MockObject_MockObject */
    private $symfonyStopwatch;
    
    public function setUp()
    {
        $this->stopwatchEvent = $this->getMock(StopwatchEvent::class);
        $this->symfonyStopwatch = $this->getMock(Stopwatch::class);
        $this->subject = new DevStopWatch($this->symfonyStopwatch);
    }

    public function testSubjectIsInstanceOfIStopWatch()
    {
        $this->assertInstanceOf('DevSpace\Interfaces\Utils\IStopwatch', $this->subject);
    }
    
    public function testStartStartsAnEvent()
    {
        $name = 'testEvent';
        $this->symfonyStopwatch
            ->expects($this->once())
            ->method('start')
            ->with($name);
        $this->subject->start($name);
    }

    public function testStopStopsAnEvent()
    {
        $name = 'testEvent';
        $this->expectStopwatchToStop($name);
        $this->subject->stop($name);
    }

    public function testGetDurationReturnsDuration()
    {
        $expected = 12345;
        $name = 'testEvent';
        $this->expectStopwatchToStop($name);
        $this->expectToReturnDuration($expected);
        $this->subject->stop($name);
        $this->assertEquals($expected, $this->subject->getDuration());
    }

    public function testGetMemoryReturnsMemoryUsage()
    {
        $expected = 56789;
        $name = 'testEvent';
        $this->expectStopwatchToStop($name);
        $this->expectToReturnMemoryUsage($expected);
        $this->subject->stop($name);
        $this->assertEquals($expected, $this->subject->getMemory());
    }

    public function testShowResultWillShowPrettyString()
    {
        $expectedDuration = 12345;
        $expectedMemory = 56789;
        $name = 'testEvent';
        $expectedResult = 'Elapsed time: 12.345 seconds. Memory usage: 55.46 kb.';
        $this->expectStopwatchToStop($name);
        $this->expectToReturnDuration($expectedDuration);
        $this->expectToReturnMemoryUsage($expectedMemory);
        $this->subject->stop($name);
        $this->assertEquals($expectedResult, $this->subject->showResult());
    }

    private function expectStopwatchToStop($name)
    {
        $this->symfonyStopwatch
            ->expects($this->once())
            ->method('stop')
            ->with($name)
            ->willReturn($this->stopwatchEvent);
    }

    private function expectToReturnDuration($expected)
    {
        $this->stopwatchEvent
            ->expects($this->once())
            ->method('getDuration')
            ->willReturn($expected);
    }

    private function expectToReturnMemoryUsage($expected)
    {
        $this->stopwatchEvent
            ->expects($this->once())
            ->method('getMemory')
            ->willReturn($expected);
    }
}