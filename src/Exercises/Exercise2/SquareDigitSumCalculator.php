<?php

declare(strict_types=1);

namespace App\Exercises\Exercise2;

class SquareDigitSumCalculator
{
	private const DECIMAL_BASE = 10;

	public function sumOfSquaresOfDigits(int $number): int
	{
		$sum = 0;
		while ($number > 0) {
			$digit = $this->extractLastDigit($number);
			$sum += $this->calculateSquare($digit);
			$number = $this->removeLastDigit($number);
		}

		return $sum;
	}

	private function extractLastDigit(int $number): int
	{
		return $number % self::DECIMAL_BASE;
	}

	private function calculateSquare(int $digit): int
	{
		return $digit * $digit;
	}

	private function removeLastDigit(int $number): int
	{
		return intdiv($number, self::DECIMAL_BASE);
	}
}
