<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseOne;

use App\Common\NumberUtil;
use App\Exercises\ExerciseOne\MultipleCheckerInterface;

class MultipleOf3Or5Strategy implements MultipleCheckerInterface
{
	public function isMultiple(int $number): bool
	{
		return NumberUtil::isMultiple($number, 3) || NumberUtil::isMultiple($number, 5);
	}
}
