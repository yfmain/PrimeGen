<?php
namespace DevSpace\Test\DI;

use DevSpace\DI\Container;
use DevSpace\Test\Core\TestCase;

class ContainerTest extends TestCase
{
    /** @var Container */
    private $subject;

    public function setUp()
    {
        $this->subject = new Container();
    }

    public function testSubjectIsInstanceOfIContainer()
    {
        $this->assertInstanceOf('DevSpace\DI\Interfaces\IContainer', $this->subject);
    }
}