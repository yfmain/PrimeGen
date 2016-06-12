<?php
namespace DevSpace\Services;

use DevSpace\Interfaces\Services\ITableConsoleOutput;
use Console_Table;

class TableConsoleOutput implements ITableConsoleOutput
{
    /** @var  Console_Table */
    private $consoleTable;
    
    public function __construct(Console_Table $consoleTable)
    {
        $this->consoleTable = $consoleTable;
    }

    public function outputArray($input, $firstItem = '')
    {
        if (empty($input)) return '';
        $headerRow = array_keys($input);
        array_unshift($headerRow, $firstItem);
        $this->consoleTable->setHeaders($headerRow);
        $this->consoleTable->addCol(array_keys($input));
        $this->consoleTable->addData($input, 1, 0);
        return $this->consoleTable->getTable();
    }
}