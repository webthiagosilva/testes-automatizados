<?php

declare(strict_types=1);

namespace App\Exercises\Exercise2;

use App\Common\NumberUtil;

class HappyNumberCalculator
{
	private const HAPPY_NUMBER = 1;

	public function isHappy(int $number): bool
	{
		if ($number < self::HAPPY_NUMBER) return false;

		$seen = [];
		while (!$this->hasReachedHappyOrRepeatedState($number, $seen)) {
			$seen[$number] = true;
			$number = $this->sumOfSquaresOfDigits($number);
		}

		return $number === self::HAPPY_NUMBER;
	}

	private function sumOfSquaresOfDigits(int $number): int
	{
		$sum = 0;
		while ($number > 0) {
			$digit = NumberUtil::extractLastDigit($number);
			$sum += NumberUtil::calculateSquare($digit);
			$number = NumberUtil::removeLastDigit($number);
		}

		return $sum;
	}

	private function hasReachedHappyOrRepeatedState(int $number, array $seen): bool
	{
		return $number === self::HAPPY_NUMBER || isset($seen[$number]);
	}
}
