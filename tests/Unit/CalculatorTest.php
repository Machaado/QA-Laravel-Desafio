<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\Calculator;

class CalculatorTest extends TestCase
{
    public function testPositivesNumbers() {
        $cal = new Calculator();

        $results = $cal->add(5,3);

        $this->assertEquals(8, $results);
    }


    public function testNegativesNumbers() {
        $cal = new Calculator();

        $results = $cal->add(-5,-3);

        $this->assertEquals(-8, $results);
    }
}
