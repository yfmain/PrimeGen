<?php
namespace DevSpace\Interfaces\Services;


interface IPrimesTable
{
    /**
     * @param int $size
     * @return array
     */
    public function getPrimesTable($size);
}