<?php
namespace DevSpace\Interfaces\MathLib;

interface ITimesTable
{
    /**
     * @param array $input
     * @return array
     */
    public function getTable(array $input);
}