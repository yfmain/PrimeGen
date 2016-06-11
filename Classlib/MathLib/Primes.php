<?php
namespace DevSpace\MathLib;

class Primes
{
    public function getTheNthPrime($n)
    {
        $primes = [];
        $count = 0;
        $i = 2;
        while ($count < $n) {
            if ($this->isPrime($i)) {
                $primes[$count++] = $i;
            }
            $i++;
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