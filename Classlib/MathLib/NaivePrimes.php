<?php
namespace DevSpace\MathLib;

use DevSpace\Interfaces\MathLib\IPrimes;

class NaivePrimes implements IPrimes
{
    public function primes($size)
    {
        if (!$this->isValid($size)) return array();

        $primes = [2];
        $count = 1;
        $i = 3;
        while ($count < $size) {
            $bound = sqrt($i);
            $prime = 3;
            foreach ($primes as $prime) {
                if ($prime > $bound) break;
                if ($i % $prime == 0) break;
            }
            if ($prime > $bound) {
                $primes[] = $i;
                $count++;
            }
            $i += 2;
        }
        return $primes;
    }

    private function isValid($n)
    {
        return filter_var($n, FILTER_VALIDATE_INT) && $n > 0;
    }
}