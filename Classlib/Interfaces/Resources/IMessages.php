<?php
namespace DevSpace\Interfaces\Resources;

interface IMessages
{
    /**
     * @param int $msgId
     * @return string | null
     */
    public function getMessage($msgId);
}