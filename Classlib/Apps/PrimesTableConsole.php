<?php
namespace DevSpace\Apps;

use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Interfaces\Validators\INaturalNumber;
use DevSpace\Interfaces\Services\ITableConsoleOutput;
use DevSpace\Interfaces\Services\IPrimesTable;
use DevSpace\Resources\Messages;

class PrimesTableConsole
{
    /** @var  IMessages */
    private $messages;

    /** @var  INaturalNumber */
    private $sizeValidator;

    /** @var  ITableConsoleOutput */
    private $outputService;

    /** @var  IPrimesTable */
    private $primesTableService;

    public function __construct(
        IMessages $messages,
        INaturalNumber $sizeValidator,
        ITableConsoleOutput $outputService,
        IPrimesTable $primesTableService
    )
    {
        $this->messages = $messages;
        $this->sizeValidator = $sizeValidator;
        $this->outputService = $outputService;
        $this->primesTableService = $primesTableService;
    }

    public function run($size)
    {
        if (!$this->sizeValidator->validate($size)) {
            return $this->messages->getMessage(Messages::MSG_PRIMES_TABLE_CONSOLE_HELP);
        }
        return $this->outputService->outputArray(
            $this->primesTableService->getPrimesTable($size)
        );
    }
}