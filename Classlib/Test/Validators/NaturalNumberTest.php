<?php
namespace DevSpace\Test\Validators;

use DevSpace\Validators\NaturalNumber;
use DevSpace\Test\Core\TestCase;

class NaturalNumberTest extends TestCase
{

    /** @var  NaturalNumber */
    private $subject;

    public function setUp()
    {
        $this->subject = new NaturalNumber();
    }

    /**
     * @param mixed $input
     * @param bool $expected
     * @dataProvider inputProvider
     */
    public function testValidateReturnsCorrectResult($input, $expected)
    {
            $this->assertEquals($expected, $this->subject->validate($input));
    }

    public function inputProvider()
    {
        return array(
            'null is invalid'              =>  array(null, false),
            'zero is invalid'              =>  array(0, false),
            'negatives are invalid'        =>  array(-1, false),
            'decimals are invalid'         =>  array(3.33, false),
            'strings are invalid'          =>  array('number', false),
            'natural numbers are valid'    =>  array(1, true)
        );
    }
}