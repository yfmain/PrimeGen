<?php
namespace DevSpace\Interfaces\Services;

interface ITableConsoleOutput
{
    /**
     * @param array $input
     * @param string $firstItem
     * @return string
     */
    public function outputArray($input, $firstItem = '');
}