<?php
namespace DevSpace\Test\Resources;

use DevSpace\Resources\Application;
use DevSpace\Resources\Messages;
use DevSpace\Test\Core\TestCase;

class MessagesTest extends TestCase
{
    /** @var  Messages */
    private $subject;

    public function setUp()
    {
        $this->subject = new Messages();
    }

    public function testGetMessageReturnsPrimesTableMessage()
    {
        $this->assertEquals(
            Application::MSG_MSG_PRIMES_TABLE_CONSOLE_HELP,
            $this->subject->getMessage(Messages::MSG_PRIMES_TABLE_CONSOLE_HELP)
        );
    }

    public function testGetMessageReturnsNullWithNonsenseInput()
    {
        $this->assertNull(
            $this->subject->getMessage(2)
        );
    }
}