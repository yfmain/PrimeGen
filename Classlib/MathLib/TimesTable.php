<?php
namespace DevSpace\MathLib;

use DevSpace\Interfaces\MathLib\ITimesTable;

class TimesTable implements ITimesTable
{
    public function getTable(array $input)
    {
        if (!$this->isValid($input)) return array();
        $inputWithKeys = array_combine($input, $input);

        return array_fill_keys($input, $inputWithKeys);
    }
    
    private function isValid(array $input)
    {
        foreach ($input as $item) {
            if (!is_numeric($item)) return false;
        }
        return true;
    }
}