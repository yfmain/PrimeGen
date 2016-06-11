<?php
namespace DevSpace\MathLib;

class Primes
{
    private $primes = [2];
    public function getTheNthPrime($n)
    {
        $count = 1;
        $i = 3;
        while ($count < $n) {
            if ($this->isPrime($i)) {
                $this->primes[$count++] = $i;
            }
            $i += 2;
        }
        return $this->primes[$n - 1];
    }

    private function isPrime($n)
    {
        $sqrtOfN = floor(sqrt($n));
        foreach ($this->primes as $prime) {
            if ($prime > $sqrtOfN) break;
            if ($n % $prime == 0) return false;
        }
        return true;
    }
}