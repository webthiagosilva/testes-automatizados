<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Common\NumberUtil;
use PHPUnit\Framework\TestCase;

class NumberUtilTest extends TestCase
{
	public function multipleProvider(): array
	{
		return [[10, 2, true], [15, 3, true], [14, 3, false], [100, 25, true], [7, 2, false]];
	}

	/**
	 * @dataProvider multipleProvider
	 */
	public function testIsMultiple(int $number, int $divisor, bool $expected): void
	{
		$this->assertEquals($expected, NumberUtil::isMultiple($number, $divisor));
	}

	public function lastDigitProvider(): array
	{
		return [[123, 3], [50, 0], [2987, 7], [1, 1]];
	}

	/**
	 * @dataProvider lastDigitProvider
	 */
	public function testExtractLastDigit(int $number, int $expected): void
	{
		$this->assertEquals($expected, NumberUtil::extractLastDigit($number));
	}

	public function squareProvider(): array
	{
		return [[3, 9], [5, 25], [10, 100], [0, 0]];
	}

	/**
	 * @dataProvider squareProvider
	 */
	public function testCalculateSquare(int $digit, int $expected): void
	{
		$this->assertEquals($expected, NumberUtil::calculateSquare($digit));
	}

	public function removeLastDigitProvider(): array
	{
		return [[1234, 123], [50, 5], [7, 0], [98765, 9876]];
	}

	/**
	 * @dataProvider removeLastDigitProvider
	 */
	public function testRemoveLastDigit(int $number, int $expected): void
	{
		$this->assertEquals($expected, NumberUtil::removeLastDigit($number));
	}

	public function primeProvider(): array
	{
		return [[2, true], [3, true], [4, false], [13, true], [25, false], [97, true], [1, false], [0, false], [-7, false]];
	}

	/**
	 * @dataProvider primeProvider
	 */
	public function testIsPrime(int $number, bool $expected): void
	{
		$this->assertEquals($expected, NumberUtil::isPrime($number));
	}
}
