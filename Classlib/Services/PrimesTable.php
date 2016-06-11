<?php
namespace DevSpace\Services;

use DevSpace\Interfaces\Services\IPrimesTable;
use DevSpace\Interfaces\MathLib\IPrimes;
use DevSpace\Interfaces\MathLib\ITimesTable;

class PrimesTable implements IPrimesTable
{
    /** @var  IPrimes */
    private $primesGenerator;
    
    /** @var  ITimesTable */
    private $timesTableGenerator;

    public function __construct(
        IPrimes $primesGenerator,
        ITimesTable $timesTableGenerator
    )
    {
        $this->primesGenerator = $primesGenerator;
        $this->timesTableGenerator = $timesTableGenerator;
    }

    public function getPrimesTable($size = null)
    {
        return $this->timesTableGenerator->getTable(
            $this->primesGenerator->primes($size)
        );
    }
}