<?php
require __DIR__ . '/../vendor/autoload.php';

use DevSpace\Validators\NaturalNumber;
use DevSpace\DI\Container;

$shortopts = "";
$shortopts .= "s:"; // Size
$shortopts .= "n"; // Naive Primes Algorithms
$options = getopt($shortopts);
$size = isset($options['s']) ? $options['s'] : null;
$isNaive = isset($options['n']);

$validator = new NaturalNumber();
if (!$validator->validate($size)) {
    echo "-------------------------------------------------------------------------------\r\n";
    echo "The Primes Number Generator...\r\n";
    echo "-------------------------------------------------------------------------------\r\n";
    echo "  Input Arguments:\r\n";
    echo "      Size of primes table, as the first argument is always required.\r\n";
    echo "      -n optional, indicating usage of the naive version of primes algorithm.\r\n\r\n";
    echo "  Example:\r\n";
    echo "      php Primes.php 20 -n\r\n";
    echo "-------------------------------------------------------------------------------\r\n";
    return;
}

$container = new Container();
if ($isNaive) {
    $container->getContainer()->setParameter('primes.algorithm', 'NaivePrimes');
}
$Primes = $container->get('DevSpace\Controllers\PrimesTableConsole');


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

/** @var \DevSpace\Utils\DevStopWatch $stopwatch */
$stopwatch = $container->get('DevStopwatch');
$stopwatch->start('PrimesGenerator');
echo $Primes->run($size);
$stopwatch->stop('PrimesGenerator');
echo "\r\n";
echo $stopwatch->showResult();
echo "\r\n";

