<?php
namespace DevSpace\MathLib;

class Primes
{
    public function getTheNthPrime($n)
    {
        $primes = [2];
        $count = 1;
        $i = 3;
        while ($count < $n) {
            if ($this->isPrime($i)) {
                $primes[$count++] = $i;
            }
            $i += 2;
        }
        return $primes[$n - 1];
    }

    private function isPrime($n)
    {
        $sqrtOfN = floor(sqrt($n));
        for ($i = 2; $i <= $sqrtOfN; $i++) {
            if ($n % $i == 0) return false;
        }
        return true;
    }
}