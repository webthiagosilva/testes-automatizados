<?php

namespace App;

class NumberComparator
{
	public function isMultipleOf($number, $of)
	{
		return $number % $of === 0;
	}
}
