<?php

declare(strict_types=1);

namespace App\Exercises\Exercise2;

use InvalidArgumentException;

class HappyNumberCalculator
{
	private const HAPPY_NUMBER = 1;

	private SquareDigitSumCalculator $calculator;

	public function __construct(SquareDigitSumCalculator $calculator)
	{
		$this->calculator = $calculator;
	}

	public function isHappy(int $number): bool
	{
		$this->validateNumber($number);

		$seen = [];
		while (!$this->hasReachedHappyOrRepeatedState($number, $seen)) {
			$seen[$number] = true;
			$number = $this->calculator->sumOfSquaresOfDigits($number);
		}

		return $number === self::HAPPY_NUMBER;
	}

	private function validateNumber(int $number): void
	{
		if ($number < 1) throw new InvalidArgumentException('Number must be greater than 0.');
	}

	private function hasReachedHappyOrRepeatedState(int $number, array $seen): bool
	{
		return $number === self::HAPPY_NUMBER || isset($seen[$number]);
	}
}
