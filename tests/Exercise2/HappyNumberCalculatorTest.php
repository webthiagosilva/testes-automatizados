<?php

use PHPUnit\Framework\TestCase;
use App\Exercises\Exercise2\HappyNumberCalculator;
use App\Exercises\Exercise2\SquareDigitSumCalculator;

class HappyNumberCalculatorTest extends TestCase
{
	private HappyNumberCalculator $calculator;

	protected function setUp(): void
	{
		$this->calculator = new HappyNumberCalculator(new SquareDigitSumCalculator());
	}

	public function testIsHappyWithHappyNumber()
	{
		$this->assertTrue($this->calculator->isHappy(1));
		$this->assertTrue($this->calculator->isHappy(7));
		$this->assertTrue($this->calculator->isHappy(10));
	}

	public function testIsHappyWithUnhappyNumber()
	{
		$this->assertFalse($this->calculator->isHappy(2));
		$this->assertFalse($this->calculator->isHappy(3));
		$this->assertFalse($this->calculator->isHappy(4));
	}

	public function testIsHappyWithLargeHappyNumber()
	{
		$this->assertTrue($this->calculator->isHappy(10000));
		$this->assertTrue($this->calculator->isHappy(67890));
		$this->assertTrue($this->calculator->isHappy(6789));
	}

	public function testIsHappyWithLargeUnhappyNumber()
	{
		$this->assertFalse($this->calculator->isHappy(1234));
		$this->assertFalse($this->calculator->isHappy(678));
		$this->assertFalse($this->calculator->isHappy(6780));
	}

	public function testAvoidsCycleNumbers()
	{
		$this->assertFalse($this->calculator->isHappy(116));
		$this->assertFalse($this->calculator->isHappy(61));
		$this->assertFalse($this->calculator->isHappy(37));
	}

	public function testIsHappyWithInvalidNumber()
	{
		$this->expectException(InvalidArgumentException::class);
		$this->calculator->isHappy(0);
	}

	public function testIsHappyWithNegativeNumber()
	{
		$this->expectException(InvalidArgumentException::class);
		$this->calculator->isHappy(-1);
	}
}
