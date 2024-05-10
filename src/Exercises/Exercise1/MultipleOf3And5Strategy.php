<?php

declare(strict_types=1);

namespace App\Exercises\Exercise1;

use App\Common\NumberUtil;
use App\Exercises\Exercise1\MultipleCheckerInterface;

class MultipleOf3And5Strategy implements MultipleCheckerInterface
{
	public function isMultiple(int $number): bool
	{
		return NumberUtil::isMultiple($number, 3) && NumberUtil::isMultiple($number, 5);
	}
}