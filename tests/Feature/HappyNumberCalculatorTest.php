<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Exercises\Exercise2\HappyNumberCalculator;

class HappyNumberCalculatorTest extends TestCase
{
	public function numberProvider(): array
	{
		return [
			[7, true],
			[97, true],
			[10, true],
			[2, false],
			[3, false],
			[4, false],
			[145, false],
			[89, false],
			[20, false],
			[116, false],
			[1, true],
			[0, false],
			[-1, false],
		];
	}

	/**
	 * @dataProvider numberProvider
	 */
	public function testIsHappy(int $number, bool $expected): void
	{
		$calculator = new HappyNumberCalculator();
		$this->assertEquals($expected, $calculator->isHappy($number));
	}
}
