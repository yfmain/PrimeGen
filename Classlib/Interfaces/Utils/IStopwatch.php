<?php
namespace DevSpace\Interfaces\Utils;

use Symfony\Component\Stopwatch\StopwatchEvent;

interface IStopwatch
{
    /**
     * @param $name
     */
    public function start($name);

    /**
     * @param $name
     */
    public function stop($name);

    /**
     * @return int
     */
    public function getDuration();

    /**
     * @return int
     */
    public function getMemory();

    /**
     * @return string
     */
    public function showResult();
}