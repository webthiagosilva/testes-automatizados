<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Exercises\ExerciseOne\MultipleOf3Or5Strategy;
use App\Exercises\ExerciseOne\MultipleOf3And5Strategy;
use App\Exercises\ExerciseOne\MultipleOf3Or5And7Strategy;

class MultipleStrategiesTest extends TestCase
{
	public function multipleOf3Or5DataProvider(): array
	{
		return [
			[3, true],
			[5, true],
			[15, true],
			[2, false],
			[7, false]
		];
	}

	/**
	 * @dataProvider multipleOf3Or5DataProvider
	 */
	public function testMultipleOf3Or5Strategy(int $number, bool $expected): void
	{
		$strategy = new MultipleOf3Or5Strategy();
		$this->assertEquals($expected, $strategy->isMultiple($number));
	}

	public function multipleOf3And5DataProvider(): array
	{
		return [
			[15, true],
			[30, true],
			[3, false],
			[5, false],
			[10, false]
		];
	}

	/**
	 * @dataProvider multipleOf3And5DataProvider
	 */
	public function testMultipleOf3And5Strategy(int $number, bool $expected): void
	{
		$strategy = new MultipleOf3And5Strategy();
		$this->assertEquals($expected, $strategy->isMultiple($number));
	}

	public function multipleOf3Or5And7DataProvider(): array
	{
		return [
			[21, true],
			[35, true],
			[105, true],
			[30, false],
			[7, false],
			[3, false],
			[5, false]
		];
	}

	/**
	 * @dataProvider multipleOf3Or5And7DataProvider
	 */
	public function testMultipleOf3Or5And7Strategy(int $number, bool $expected): void
	{
		$strategy = new MultipleOf3Or5And7Strategy();
		$this->assertEquals($expected, $strategy->isMultiple($number));
	}
}
