<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Helpers\FormatHelper;

class FormatHelperTest extends TestCase
{
    public function testWithInvalidPhoneNumber()
    {
        $invalidPhoneNumber = "aa9";
        $expected = "9";
        $received = FormatHelper::phoneFormat($invalidPhoneNumber);
        $this->assertEquals($expected, $received);
    }

    public function testWithEightDigitsPhoneNumber()
    {
        $eightDigitsPhoneNumber = "32296666";
        $expected = "3229-6666";
        $received = FormatHelper::phoneFormat($eightDigitsPhoneNumber);
        $this->assertEquals($expected, $received);
    }

    public function testWithNineDigitsPhoneNumber()
    {
        $nineDigitsPhoneNumber = "984554589";
        $expected = "9 8455-4589";
        $received = FormatHelper::phoneFormat($nineDigitsPhoneNumber);
        $this->assertEquals($expected, $received);
    }

    public function testWithTenDigitsPhoneNumber()
    {
        $tenDigitsPhoneNumber = "4899996666";
        $expected = "(48) 9999-6666";
        $received = FormatHelper::phoneFormat($tenDigitsPhoneNumber);
        $this->assertEquals($expected, $received);
    }

    public function testWithElevenDigitsPhoneNumber()
    {
        $elevenDigitsPhoneNumber = "48999996666";
        $expected = "(48) 9 9999-6666";
        $received = FormatHelper::phoneFormat($elevenDigitsPhoneNumber);
        $this->assertEquals($expected, $received);
    }

    public function testWithLessThanEightDigitsPhoneNumber()
    {
        $lessThanEightDigitsPhoneNumber = "9999999";
        $expected = $lessThanEightDigitsPhoneNumber;
        $received = FormatHelper::phoneFormat($lessThanEightDigitsPhoneNumber);
        $this->assertEquals($expected, $received);
    }

    public function testWithMoreThanElevenDigitsPhoneNumber()
    {
        $moreThanElevenDigitsPhoneNumber = "999999999999";
        $expected = $moreThanElevenDigitsPhoneNumber;
        $received = FormatHelper::phoneFormat($moreThanElevenDigitsPhoneNumber);
        $this->assertEquals($expected, $received);
    }
}