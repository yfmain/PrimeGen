<?php
namespace DevSpace\Apps;

use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Interfaces\Validators\INaturalNumber;

class PrimesTableConsole
{
    /** @var  IMessages */
    private $messages;

    /** @var  INaturalNumber */
    private $sizeValidator;

    public function __construct(
        IMessages $messages,
        INaturalNumber $sizeValidator
    )
    {
        $this->messages = $messages;
        $this->sizeValidator = $sizeValidator;
    }

    public function run($size)
    {
        if (!$this->sizeValidator->validate($size)) {
            return $this->messages->getMessage('MSG_PRMGEN_INVALID_INPUT');
        }
    }
}