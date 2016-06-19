<?php
namespace DevSpace\MathLib;

use DevSpace\Interfaces\MathLib\IPrimes;

class IncrementalSieve implements IPrimes
{
    private $primes = [2];

    public function primes($size)
    {
        if (!$this->isValid($size)) return array();
        ini_set('memory_limit', '2G');
        $composites = array();
        $count = 1;
        $p = 3;
        while ($count < $size) {
            if (isset($composites[$p])) {
                $pv = $composites[$p];
                $q = $p + 2 * $pv;
                while (isset($composites[$q])) {
                    $q += 2 * $pv;
                }
                $composites[$q] = $pv;
                unset($composites[$p]);
            } else
            {
                $this->primes[] = $p;
                $count++;
                $composites[(string) ($p * $p)] = $p;
            }
            $p+=2;
        }
        return $this->primes;
    }

    private function isValid($n)
    {
        return filter_var($n, FILTER_VALIDATE_INT) && $n > 0;
    }    
}