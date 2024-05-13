<?php

declare(strict_types=1);

namespace App\Common;

class NumberUtil
{
	private const DECIMAL_BASE = 10;

	public static function isMultiple(int $number, int $divisor): bool
	{
		return $number % $divisor === 0;
	}

	public static function calculateSquare(int $digit): int
	{
		return $digit * $digit;
	}

	public static function extractLastDigit(int $number): int
	{
		return $number % self::DECIMAL_BASE;
	}

	public static function removeLastDigit(int $number): int
	{
		return intdiv($number, self::DECIMAL_BASE);
	}

	public static function isPrime(int $number): bool
	{
		if ($number < 2) return false;

		for ($divisor = 2; $divisor <= sqrt($number); $divisor++) {
			if (self::isMultiple($number, $divisor)) return false;
		}

		return true;
	}
}
