<?php
namespace DevSpace\Utils;

use DevSpace\Interfaces\Utils\IStopwatch;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Stopwatch\StopwatchEvent;

class DevStopWatch implements IStopwatch
{
    /** @var  Stopwatch */
    private $stopwatch;
    /** @var  StopwatchEvent */
    private $stopwatchEvent;
    
    public function __construct(Stopwatch $stopwatch)
    {
        $this->stopwatch = $stopwatch;
    }

    public function start($name)
    {
        $this->stopwatchEvent = $this->stopwatch->start($name);
    }

    public function stop($name)
    {
        $this->stopwatchEvent = $this->stopwatch->stop($name);
    }

    public function getDuration()
    {
        return $this->stopwatchEvent->getDuration();
    }

    public function getMemory()
    {
        return $this->stopwatchEvent->getMemory();
    }

    public function showResult()
    {
        $duration = $this->getDuration() / 1000;
        $memoryUsage = $this->nonCleanConvert($this->getMemory());
        return "Elapsed time: $duration seconds. Memory usage: $memoryUsage.";
    }

    private function nonCleanConvert($size)
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        $index = (int)floor(log($size,1024));
        return @round($size / pow(1024, $index), 2).' '.$unit[$index];
    }
}