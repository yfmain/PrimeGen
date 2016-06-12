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
     * @param array $input
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

    /**
     * @param array $input
     * @param array $expected
     * @dataProvider TimesTableProvider
     */
    public function testGetTableReturnsCorrectResult($input, $expected)
    {
        $this->assertEquals($expected, $this->subject->getTable($input));
    }

    public function TimesTableProvider()
    {
        return array(
            'input array has only 1 element of 0' => array(
                array(0),
                array(
                    0 => array( 0 => 0 )
                )
            ),
            'input array has only 1 element of 1' => array(
                array(1),
                array(
                    1 => array( 1 => 1 )
                )
            ),
            'input array has only 1 element of 2' => array(
                array(2),
                array(
                    2 => array( 2 => 4 )
                )
            ),

        );
    }

}