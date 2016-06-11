<?php
namespace DevSpace\MathLib;

class Primes
{
    public function primes($n)
    {
        if (!$n)
        {
            return array();
        }
        $primes = [2];
        $count = 1;
        $i = 3;
        while ($count < $n) {
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
}