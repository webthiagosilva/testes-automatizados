<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Exercises\Exercise1\MultipleSumCalculator;
use App\Exercises\Exercise1\MultipleOf3Or5Strategy;
use App\Exercises\Exercise1\MultipleOf3And5Strategy;
use App\Exercises\Exercise1\MultipleOf3Or5And7Strategy;

class MultipleSumCalculatorTest extends TestCase
{
    public function testSumOfMultiplesOf3Or5()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3Or5Strategy());
        $this->assertEquals(234168, $calculator->calculateSum(1000));
    }

    public function testSumOfMultiplesOf3And5()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3And5Strategy());
        $this->assertEquals(33165, $calculator->calculateSum(1000));
    }

    public function testSumOfMultiplesOf3Or5And7()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3Or5And7Strategy());
        $this->assertEquals(33173, $calculator->calculateSum(1000));
    }
}
