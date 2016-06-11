<?php
namespace DevSpace\MathLib;

class Primes
{
    public function getTheNthPrime($n)
    {
        $primes = [];
        $count = 0;
        for ($i = 2; $i < $n + 100; $i++) {
            if ($this->isPrime($i)) {
                $primes[] = $i;
                if (++$count == $n) break;
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