<?php
namespace DevSpace\Interfaces\Services;

interface IConsole extends IOutput
{
    /**
     * @param array $input
     * @return string
     */
    public function displayArray($input);
}