<?php

namespace App\Exercises\Exercise1\Strategies;

use App\Exercises\Exercise1\Interfaces\MultipleRuleStrategyInterface;

class MultipleOf3Or5And7Strategy implements MultipleRuleStrategyInterface
{
	public function isMultiple(int $number): bool
	{
		return ($number % 3 === 0 || $number % 5 === 0) && $number % 7 === 0;
	}
}
