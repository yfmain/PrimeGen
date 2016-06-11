<?php
namespace DevSpace\Resources;

use DevSpace\Interfaces\Resources\IMessages;

class Messages implements IMessages
{
    const MSG_PRIMES_TABLE_CONSOLE_HELP = 1;
    
    public function getMessage($msgId)
    {
        if ($msgId == self::MSG_PRIMES_TABLE_CONSOLE_HELP) {
            return Application::MSG_MSG_PRIMES_TABLE_CONSOLE_HELP;
        }
    }
}