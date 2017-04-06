<?php

namespace Dgame\Ternary\Tests;

use Dgame\Ternary\Ternary;
use PHPUnit\Framework\TestCase;

class TernaryTest extends TestCase
{
    public function testUnknown()
    {
        $ternary = Ternary::unknown();
        $this->assertTrue($ternary->isUnknown());
        $this->assertFalse($ternary->isYes());
        $this->assertFalse($ternary->isNo());
        $this->assertEquals(Ternary::UNKNOWN, $ternary->getId());
    }

    public function testYes()
    {
        $ternary = Ternary::yes();
        $this->assertFalse($ternary->isUnknown());
        $this->assertTrue($ternary->isYes());
        $this->assertFalse($ternary->isNo());
        $this->assertEquals(Ternary::YES, $ternary->getId());
    }

    public function testNo()
    {
        $ternary = Ternary::no();
        $this->assertFalse($ternary->isUnknown());
        $this->assertFalse($ternary->isYes());
        $this->assertTrue($ternary->isNo());
        $this->assertEquals(Ternary::NO, $ternary->getId());
    }

    public function testTranslate()
    {
        $this->assertEquals(Ternary::unknown(), Ternary::translate(Ternary::UNKNOWN));
        $this->assertEquals(Ternary::no(), Ternary::translate(Ternary::NO));
        $this->assertEquals(Ternary::yes(), Ternary::translate(Ternary::YES));

        $this->assertEquals(Ternary::unknown(), Ternary::translate(-1));
        $this->assertEquals(Ternary::no(), Ternary::translate(false));
        $this->assertEquals(Ternary::yes(), Ternary::translate(true));
    }

    public function testInvert()
    {
        $this->assertEquals(Ternary::UNKNOWN, Ternary::unknown()->invert()->getId());
        $this->assertEquals(Ternary::NO, Ternary::yes()->invert()->getId());
        $this->assertEquals(Ternary::YES, Ternary::no()->invert()->getId());
    }
}