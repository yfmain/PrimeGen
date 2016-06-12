<?php
namespace DevSpace\MathLib;

use DevSpace\Interfaces\MathLib\ITimesTable;

class TimesTable implements ITimesTable
{
    public function getTable(array $input)
    {
        if (!$this->isValid($input)) return array();
        $result = array_fill_keys($input, array_combine($input, $input));
        foreach ($result as $key => &$item) {
            $item[$key] *= $item[$key];
        }
        return $result;
    }
    
    private function isValid(array $input)
    {
        foreach ($input as $item) {
            if (!is_numeric($item)) return false;
        }
        return true;
    }
}