<?php
namespace DevSpace\MainApp;

use DevSpace\Interfaces\Resources\IMessages;
use DevSpace\Interfaces\Validators\INaturalNumber;
use DevSpace\Interfaces\MathLib\IPrimes;

class PrimesGenerator
{
    /** @var  IMessages */
    private $messages;

    /** @var  INaturalNumber */
    private $sizeValidator;
    
    /** @var  IPrimes */
    private $primesGenerator;
    
    public function __construct(
        IMessages $messages,
        INaturalNumber $sizeValidator,
        IPrimes $primesGenerator
    )
    {
        $this->messages = $messages;
        $this->sizeValidator = $sizeValidator;
        $this->primesGenerator = $primesGenerator;
    }

    public function run($size = null)
    {
        if (!$this->sizeValidator->validate($size)) {
            return $this->messages->getMessage('MSG_PRMGEN_INVALID_INPUT');
        }
        return $this->primesGenerator->primes($size);
    }
}