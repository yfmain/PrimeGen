<?php
namespace DevSpace\Test\MathLib;

use DevSpace\MathLib\TimesTable;
use DevSpace\Test\Core\TestCase;

class TimesTableTest extends TestCase
{
    /** @var  TimesTable */
    private $subject;

    public function setUp()
    {
        $this->subject = new TimesTable();
    }

    public function testSubjectIsInstanceOfITimesTable()
    {
        $this->assertInstanceOf('DevSpace\Interfaces\MathLib\ITimesTable', $this->subject);
    }

    /**
     * @param mixed $input
     * @dataProvider InvalidArgsProvider
     */
    public function testGetTableReturnsEmptyWithInvalidInput($input)
    {
        $this->assertEquals(array(), $this->subject->getTable($input));
    }
    
    public function InvalidArgsProvider()
    {
        return array(
            'array with null elements is invalid'        => array(array(2, null)),
            'array with non-numeric elements is invalid' => array(array(2, 's'))
        );
    }
}