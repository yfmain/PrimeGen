<?php
namespace DevSpace\Test\DI;

use DevSpace\DI\Container;
use DevSpace\Test\Core\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ContainerTest extends TestCase
{
    /** @var Container */
    private $subject;
    
    public function setUp()
    {
        $this->subject =  new Container();
    }
    
    public function testSubjectIsInstanceOfIContainer()
    {
        $this->assertInstanceOf('DevSpace\DI\Interfaces\IContainer', $this->subject);
    }

    public function testGetReturnsInstance()
    {
        $this->assertInstanceOf('DevSpace\DI\Container', $this->subject->get('DevSpace\DI\Container'));
    }

    public function testGetContainerWillReturnContainerBuilder()
    {
        $this->assertInstanceOf(
            'Symfony\Component\DependencyInjection\ContainerBuilder',
            $this->subject->getContainer());
    }
}