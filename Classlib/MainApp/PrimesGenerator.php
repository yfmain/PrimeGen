<?php
namespace DevSpace\MainApp;

use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Interfaces\Validators\INaturalNumber;
use DevSpace\Interfaces\MathLib\IPrimes;
use DevSpace\Interfaces\MathLib\ITimesTable;

class PrimesGenerator
{
    /** @var  IMessages */
    private $messages;

    /** @var  INaturalNumber */
    private $sizeValidator;
    
    /** @var  IPrimes */
    private $primesGenerator;
    
    /** @var  ITimesTable */
    private $timesTableGenerator;

    public function __construct(
        IMessages $messages,
        INaturalNumber $sizeValidator,
        IPrimes $primesGenerator,
        ITimesTable $timesTableGenerator
    )
    {
        $this->messages = $messages;
        $this->sizeValidator = $sizeValidator;
        $this->primesGenerator = $primesGenerator;
        $this->timesTableGenerator = $timesTableGenerator;
    }

    public function run($size = null)
    {
        if (!$this->sizeValidator->validate($size)) {
            return $this->messages->getMessage('MSG_PRMGEN_INVALID_INPUT');
        }
        
        return $this->timesTableGenerator->getTable(
            $this->primesGenerator->primes($size)
        );
    }
}