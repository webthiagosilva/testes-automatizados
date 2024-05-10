<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Exercises\Exercise3\WordToNumberConverter;

class WordToNumberConverterTest extends TestCase
{
	public function wordProvider()
	{
		return [
			['abc', 1 + 2 + 3],
			['ABC', 27 + 28 + 29],
			['aBc', 1 + 28 + 3],
			['zZ', 26 + 52],
			['123', 0],
			['!@#$', 0],
			['aBc123', 1 + 28 + 3],
			['Jesus is the king', 202]
		];
	}

	/**
	 * @dataProvider wordProvider
	 */
	public function testConvertToNumber(string $word, int $expectedSum)
	{
		$converter = new WordToNumberConverter();
		$this->assertEquals($expectedSum, $converter->convertToNumber($word));
	}
}
