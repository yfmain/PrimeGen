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
            $bound = sqrt($i);
            $prime = 3;
            foreach ($this->primes as $prime) {
                if ($prime > $bound) break;
                if ($i % $prime == 0) break;
            }
            if ($prime > $bound) {
                $this->primes[] = $i;
                $count++;
            }
            $i += 2;
        }
        return $this->primes[$n - 1];
    }

}