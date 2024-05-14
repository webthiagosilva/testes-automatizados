<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseThree;

class WordToNumberConverter
{
	private const OFFSET_LOWERCASE = 'a';
	private const OFFSET_UPPERCASE = 'A';
	private const BASE_VALUE_LOWERCASE = 1;
	private const BASE_VALUE_UPPERCASE = 27;

	public function convertToNumber(string $word): int
	{
		$sum = 0;
		foreach (str_split($word) as $char) {
			$sum += $this->getCharValue($char);
		}

		return $sum;
	}

	private function getCharValue(string $char): int
	{
		if (ctype_alpha($char)) {
			return $this->calculateValue($char);
		}

		return 0;
	}

	private function calculateValue(string $char): int
	{
		$offset = ctype_lower($char) ? ord(self::OFFSET_LOWERCASE) : ord(self::OFFSET_UPPERCASE);
		$baseValue = ctype_lower($char) ? self::BASE_VALUE_LOWERCASE : self::BASE_VALUE_UPPERCASE;

		return ord($char) - $offset + $baseValue;
	}
}
