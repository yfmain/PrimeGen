<?php
namespace DevSpace\Apps;

use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Interfaces\Validators\INaturalNumber;
use DevSpace\Interfaces\Services\IOutput;

class PrimesTableConsole
{
    /** @var  IMessages */
    private $messages;

    /** @var  INaturalNumber */
    private $sizeValidator;

    /** @var  IOutput */
    private $outputService;

    public function __construct(
        IMessages $messages,
        INaturalNumber $sizeValidator,
        IOutput $outputService
    )
    {
        $this->messages = $messages;
        $this->sizeValidator = $sizeValidator;
        $this->outputService = $outputService;
    }

    public function run($size)
    {
        if (!$this->sizeValidator->validate($size)) {
            $this->outputService->display(
                $this->messages->getMessage('MSG_PRMGEN_INVALID_INPUT')
            );
        }
    }
}