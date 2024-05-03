<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Exercises\Exercise1\MultipleSumCalculator;
use App\Exercises\Exercise1\Strategies\MultipleOf3Or5Strategy;
use App\Exercises\Exercise1\Strategies\MultipleOf3And5Strategy;
use App\Exercises\Exercise1\Strategies\MultipleOf3Or5And7Strategy;


class MultipleSumCalculatorTest extends TestCase
{
    public function testSumOfMultiplesOf3Or5()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3Or5Strategy());
        $this->assertEquals(234168, $calculator->calculateSum(1000));
    }

    public function testSumOfMultiplesOf3Or5Boundary()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3Or5Strategy());
        $this->assertEquals(234168, $calculator->calculateSum(1000));
        $this->assertEquals(233168, $calculator->calculateSum(999));
        $this->assertEquals(235170, $calculator->calculateSum(1003));
    }

    public function testSumOfMultiplesOf3And5()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3And5Strategy());
        $this->assertEquals(33165, $calculator->calculateSum(1000));
    }

    public function testSumOfMultiplesOf3And5Boundary()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3And5Strategy());
        $this->assertEquals(33165, $calculator->calculateSum(1000));
        $this->assertEquals(33165, $calculator->calculateSum(999));
        $this->assertEquals(34170, $calculator->calculateSum(1005));
    }

    public function testSumOfMultiplesOf3Or5And7()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3Or5And7Strategy());
        $this->assertEquals(33173, $calculator->calculateSum(1000));
    }

    public function testSumOfMultiplesOf3Or5And7Boundary()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3Or5And7Strategy());
        $this->assertEquals(33173, $calculator->calculateSum(1000));
        $this->assertEquals(33173, $calculator->calculateSum(999));
        $this->assertEquals(34181, $calculator->calculateSum(1008));
    }

    public function testSumOfMultiplesOf3Or5SmallInput()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3Or5Strategy());
        $this->assertEquals(0, $calculator->calculateSum(0));
        $this->assertEquals(0, $calculator->calculateSum(1));
        $this->assertEquals(3, $calculator->calculateSum(4));
    }

    public function testSumOfMultiplesOf3And5SmallInput()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3And5Strategy());
        $this->assertEquals(0, $calculator->calculateSum(0));
        $this->assertEquals(0, $calculator->calculateSum(1));
        $this->assertEquals(0, $calculator->calculateSum(14));
    }

    public function testSumOfMultiplesOf3Or5And7SmallInput()
    {
        $calculator = new MultipleSumCalculator(new MultipleOf3Or5And7Strategy());
        $this->assertEquals(0, $calculator->calculateSum(0));
        $this->assertEquals(0, $calculator->calculateSum(1));
        $this->assertEquals(0, $calculator->calculateSum(20));
    }
}
