<?php
namespace DevSpace\DI\Interfaces;


interface IContainer
{
    /**
     * @param string $serviceName
     * @return mixed
     */
    public function get($serviceName);
}