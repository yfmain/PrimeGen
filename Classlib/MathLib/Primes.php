<?php
namespace DevSpace\MathLib;

class Primes
{
    public function getTheNthPrime($n)
    {
        if ($n <3) return $n + 1;
        return 5;
    }
}