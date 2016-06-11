<?php
namespace DevSpace\MainApp;

use DevSpace\Interfaces\Resources\IMessages;

class PrimesGenerator
{
    /** @var  IMessages */
    private $messages;
    
    public function __construct(
        IMessages $messages
    )
    {
        $this->messages = $messages;
    }

    public function run($size = null)
    {
        if (!$size) {
            $this->messages->getMessage('MSG_PRMGEN_INVALID_INPUT');
        }
    }
}