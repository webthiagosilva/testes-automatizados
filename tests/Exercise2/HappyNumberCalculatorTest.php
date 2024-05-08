<?php

use PHPUnit\Framework\TestCase;
use App\Exercises\Exercise2\HappyNumberCalculator;
use App\Exercises\Exercise2\DigitCalculator;

class HappyNumberCalculatorTest extends TestCase
{
	// public function testRejectsNonPositiveNumbers()
	// {
	// 	$calculator = new HappyNumberCalculator(new DigitCalculator());

	// 	$this->expectException(InvalidArgumentException::class);
	// 	$calculator->isHappy(-1);
	// }

	// public function testRejectsNonIntegerNumbers()
	// {
	// 	$calculator = new HappyNumberCalculator(new DigitCalculator());

	// 	$this->expectException(InvalidArgumentException::class);
	// 	$calculator->isHappy(1.5);
	// }

	// public function testIsHappyNumber()
	// {
	// 	$calculator = new HappyNumberCalculator(new DigitCalculator());

	// 	$this->assertTrue($calculator->isHappy(1));
	// 	$this->assertTrue($calculator->isHappy(7));
	// 	$this->assertTrue($calculator->isHappy(19));
	// }

	// public function testIsNotHappyNumber()
	// {
	// 	$calculator = new HappyNumberCalculator(new DigitCalculator());

	// 	$this->assertFalse($calculator->isHappy(2));
	// 	$this->assertFalse($calculator->isHappy(4));
	// 	$this->assertFalse($calculator->isHappy(20));
	// }

	// public function testAvoidsInfiniteLoop()
	// {
	// 	$calculator = new HappyNumberCalculator(new DigitCalculator());

	// 	$this->assertFalse($calculator->isHappy(116));
	// }
}
