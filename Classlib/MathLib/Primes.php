<?php
namespace DevSpace\MathLib;

class Primes
{
    public function getTheNthPrime($n)
    {
        $primes = [];

        for ($i = 2; $i < $n + 10; $i++) {
            if ($this->isPrime($i)) {
                $primes[] = $i;
            }
        }
        return $primes[$n - 1];
    }

    private function isPrime($n)
    {
        for ($i = 2; $i < $n; $i++) {
            if ($n % $i == 0) return false;
        }
        return true;
    }
}