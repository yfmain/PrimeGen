<?php
require __DIR__ . '/../vendor/autoload.php';

use DevSpace\Apps\PrimesTableConsole;
use DevSpace\Resources\Messages;
use DevSpace\Validators\NaturalNumber;
use DevSpace\MathLib\NaivePrimes;
use DevSpace\MathLib\IncrementalSieve;
use DevSpace\MathLib\TimesTable;
use DevSpace\Services\PrimesTable;
use DevSpace\Services\TableConsoleOutput;

$shortopts = "";
$shortopts .= "s:"; // Size
$shortopts .= "n"; // Naive Primes Algorithms
$options = getopt($shortopts);
$size = isset($options['s']) ? $options['s'] : null;
$isNaive = isset($options['n']);

$validator = new NaturalNumber();
if (!$validator->validate($size)) {
    echo "-------------------------------------------------------------------------------";
    echo "\r\n";
    echo "The Primes Number Generator...";
    echo "\r\n";
    echo "-------------------------------------------------------------------------------";
    echo "\r\n";
    echo "  Input Arguments:";
    echo "\r\n";
    echo "      Size of primes table, as the first argument is always required.";
    echo "\r\n";
    echo "      -n optional, indicating usage of the naive version of primes algorithm.";
    echo "\r\n\r\n";
    echo "  Example:";
    echo "\r\n";
    echo "      php Primes.php 20 -n";
    echo "\r\n";
    echo "-------------------------------------------------------------------------------";
    echo "\r\n";
    return;
}

$messages = new Messages();
$timesTableGenerator = new TimesTable();
$primesGenerator = $isNaive ? new NaivePrimes() : new IncrementalSieve();
$primesTableService = new PrimesTable($primesGenerator, $timesTableGenerator);
$outputService = new TableConsoleOutput(new Console_Table(CONSOLE_TABLE_ALIGN_RIGHT));

$Primes = new PrimesTableConsole($messages, $validator, $outputService, $primesTableService);

function convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

echo "-------------------------------------------------------------------";
echo "\r\n";
echo !$isNaive ? "Prime Times Table - Incremental Sieve of Eratosthenes:" : "Prime Times Table - Naive Version:";
echo "\r\n";
echo "-------------------------------------------------------------------";
echo "\r\n\r\n";
if ($size >= 1e6) {
    echo "For size over 15 millions, it may crash due to the limited memory allocated to it.";
    echo "\r\n";
    echo "For every million prime numbers, it takes roughly 5 - 10 seconds to execute..";
    echo "\r\n";
    echo "Please wait ...";
    echo "\r\n\r\n";
}
$memoryUsage = memory_get_usage();
$time_start = microtime(true);
echo $Primes->run($size);
$time_end = microtime(true);
$time = $time_end - $time_start;
$memoryUsage = convert(memory_get_usage() - $memoryUsage);
echo "\r\n";
echo "Elapsed time: $time seconds. Memory usage: $memoryUsage.\n";
