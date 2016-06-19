<?php
namespace DevSpace\Test\Core;

class TestCase extends \PHPUnit_Framework_TestCase
{
    public function getMock($class)
    {
        return $this->createMock($class);
    }
}