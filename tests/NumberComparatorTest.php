<?php

namespace Tests;

use App\NumberComparator;
use PHPUnit\Framework\TestCase;

class NumberComparatorTest extends TestCase
{
	public function testIsMultipleOf()
	{
		$comparator = new NumberComparator();

		$this->assertTrue($comparator->isMultipleOf(10, 5));
		$this->assertFalse($comparator->isMultipleOf(10, 3));
	}
}
