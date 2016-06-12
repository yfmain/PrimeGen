<?php
namespace DevSpace\Interfaces\MathLib;

interface IPrimes
{
    /**
     * @param int $size
     * @return array
     */
    public function primes($size);
}
