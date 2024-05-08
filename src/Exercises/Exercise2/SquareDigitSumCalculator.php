<?php

namespace App\Exercises\Exercise2;

use InvalidArgumentException;

class SquareDigitSumCalculator
{
	private const DECIMAL_SYSTEM_BASE = 10;

	public function sumOfSquaresOfDigits(int $number): int
	{
		$this->validade($number);

		$sum = 0;
		while ($number > 0) {
			$digit = $this->extractLastDigit($number);
			$sum += $this->calculateSquare($digit);
			$number = $this->removeLastDigit($number);
		}

		return $sum;
	}

	private function validade($number): void
	{
		if ($number < 0) throw new InvalidArgumentException('Number must be a possitive intege.');
	}

	private function extractLastDigit(int $number): int
	{
		return $number % self::DECIMAL_SYSTEM_BASE;
	}

	private function calculateSquare(int $digit): int
	{
		return $digit * $digit;
	}

	private function removeLastDigit(int $number): int
	{
		return intdiv($number, self::DECIMAL_SYSTEM_BASE);
	}
}
