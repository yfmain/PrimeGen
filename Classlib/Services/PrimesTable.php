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

    const MAX_DISPLAYABLE_COLUMNS = 12;

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
        $primesToOutput = $this->primesGenerator->primes($size);

        //TODO: do output paging..., move paging logic out of here.
        //this is only a temporary hiking, this need to be replace by a proper paging solution
        $max = self::MAX_DISPLAYABLE_COLUMNS;
        if ($size > $max) {
            $primesToOutput = array_merge(
                array_slice($primesToOutput, 0, floor($max/2)),
                array_slice($primesToOutput, -floor($max/2))
            );
        }

        return $this->timesTableGenerator->getTable(
            $primesToOutput
        );
    }
}