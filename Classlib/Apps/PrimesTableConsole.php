<?php
namespace DevSpace\Apps;

use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Interfaces\Validators\INaturalNumber;
use DevSpace\Interfaces\Services\IConsole;
use DevSpace\Interfaces\Services\IPrimesTable;

class PrimesTableConsole
{
    /** @var  IMessages */
    private $messages;

    /** @var  INaturalNumber */
    private $sizeValidator;

    /** @var  IConsole */
    private $outputService;

    /** @var  IPrimesTable */
    private $primesTableService;

    public function __construct(
        IMessages $messages,
        INaturalNumber $sizeValidator,
        IConsole $outputService,
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
            $this->outputService->display(
                $this->messages->getMessage('MSG_PRMGEN_INVALID_INPUT')
            );
        }
        $this->outputService->displayArray(
            $this->primesTableService->getPrimesTable($size)
        );
    }
}