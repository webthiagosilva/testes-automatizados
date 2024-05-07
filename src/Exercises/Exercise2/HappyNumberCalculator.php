<?php

namespace App\Exercises\Exercise2;

class HappyNumberCalculator
{
	private const HAPPY_NUMBER = 1;

	public function isHappy(int $number): bool
	{
		$seen = [];
		while ($number != self::HAPPY_NUMBER && !isset($seen[$number])) {
			$seen[$number] = true;
			$number = $this->sumOfSquaresOfDigits($number);
		}
		return $number === self::HAPPY_NUMBER;
	}

	private function sumOfSquaresOfDigits(int $number): int
	{
		$sum = 0;
		while ($number > 0) {
			$digit = $number % 10;
			$sum += $digit * $digit;
			$number = intdiv($number, 10);
		}
		return $sum;
	}
}
