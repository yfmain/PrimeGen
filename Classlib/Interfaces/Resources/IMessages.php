<?php
namespace DevSpace\Interfaces\Resources;

interface IMessages
{
    /**
     * @param string $msgId
     * @return string
     */
    public function getMessage($msgId);
}