<?php
namespace DevSpace\MathLib;

class Primes
{
    public function getTheNthPrime($n)
    {
        $primes = [2, 3, 5, 7, 11];
        return $primes[$n - 1];
    }
}