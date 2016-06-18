<?php
namespace DevSpace\Test\IntegrationTests;

use DevSpace\DI\Container;
use DevSpace\Test\Core\TestCase;
use Exception;
class ContainerIntegrationTest extends TestCase
{

    /** @var  Container */
    private $subject;

    public function setUp()
    {
        $this->subject = new Container();
    }

    public function testDIConfigurationValid()
    {
        try {
            $this->subject->getContainer()->compile();
        } catch (Exception $e) {
            $this->assertTrue(false, $e->getMessage() );
        }
    }

    public function testPrimesGeneratorGetObjectByDefaultParameter()
    {
        $this->assertInstanceOf(
            'DevSpace\MathLib\IncrementalSieve',
            $this->subject->get('PrimesGenerator'),
            'Container should return IncrementalSieve by default'
        );
    }

    public function testPrimesGeneratorGetObjectViaNewlySetParameter()
    {
        $this->subject->getContainer()->setParameter('primes.algorithm', 'NaivePrimes');
        $this->assertInstanceOf(
            'DevSpace\MathLib\NaivePrimes',
            $this->subject->get('PrimesGenerator'),
            'Container should return classes set by parameter'
        );
    }
}