<?php

use PHPUnit\Framework\TestCase;
use App\Exercises\Exercise2\SquareDigitSumCalculator;

class SquareDigitSumCalculatorTest extends TestCase
{
	private $calculator;

	protected function setUp(): void
	{
		$this->calculator = new SquareDigitSumCalculator();
	}

	public function testSumOfSquaresOfSingleDigit()
	{
		$this->assertEquals(1, $this->calculator->sumOfSquaresOfDigits(1));
		$this->assertEquals(16, $this->calculator->sumOfSquaresOfDigits(4));
		$this->assertEquals(81, $this->calculator->sumOfSquaresOfDigits(9));
	}

	public function testSumOfSquaresOfMultipleDigits()
	{
		$this->assertEquals(1, $this->calculator->sumOfSquaresOfDigits(10));
		$this->assertEquals(13, $this->calculator->sumOfSquaresOfDigits(23));
		$this->assertEquals(25, $this->calculator->sumOfSquaresOfDigits(34));
	}

	public function testSumOfSquaresOfLargeNumbers()
	{
		$this->assertEquals(30, $this->calculator->sumOfSquaresOfDigits(1234));
		$this->assertEquals(230, $this->calculator->sumOfSquaresOfDigits(6789));
	}

	public function testSumOfSquaresWithZero()
	{
		$this->assertEquals(0, $this->calculator->sumOfSquaresOfDigits(0));
	}

	public function testHandlesNegativeNumbers()
	{
		$this->expectException(InvalidArgumentException::class);
		$this->calculator->sumOfSquaresOfDigits(-123);
	}
}
