<?php
require __DIR__ . '/../vendor/autoload.php';

use DevSpace\Apps\PrimesTableConsole;
use DevSpace\Resources\Messages;
use DevSpace\Validators\NaturalNumber;
use DevSpace\MathLib\Primes;
use DevSpace\MathLib\TimesTable;
use DevSpace\Services\PrimesTable;
use DevSpace\Services\TableConsoleOutput;

$validator = new NaturalNumber();
$messages = new Messages();
$primesGenerator = new Primes();
$timesTableGenerator = new TimesTable();
$primesTableService = new PrimesTable($primesGenerator, $timesTableGenerator);
$outputService = new TableConsoleOutput(new Console_Table(CONSOLE_TABLE_ALIGN_RIGHT));

$Primes = new PrimesTableConsole($messages, $validator, $outputService, $primesTableService);

echo $Primes->run(1);
