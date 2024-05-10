<?php

declare(strict_types=1);

namespace Tests\Exercise3;

use PHPUnit\Framework\TestCase;
use App\Exercises\Exercise3\WordToNumberConverter;
use App\Exercises\Exercise3\WordPropertiesChecker;
use App\Exercises\Exercise2\HappyNumberCalculator;
use App\Exercises\Exercise1\MultipleOf3Or5Strategy;

class WordPropertiesCheckerTest extends TestCase
{
	public function wordPropertiesProvider()
	{
		return [
			['abc', ['isPrime' => false, 'isHappy' => false, 'isMultipleOf3Or5' => true]],
			['happy', ['isPrime' => false, 'isHappy' => false, 'isMultipleOf3Or5' => true]],
			['sad', ['isPrime' => false, 'isHappy' => false, 'isMultipleOf3Or5' => true]],
			['123', ['isPrime' => false, 'isHappy' => false, 'isMultipleOf3Or5' => false]],
			['!@#', ['isPrime' => false, 'isHappy' => false, 'isMultipleOf3Or5' => false]],
			['', ['isPrime' => false, 'isHappy' => false, 'isMultipleOf3Or5' => false]],
			['a1b2c3', ['isPrime' => false, 'isHappy' => false, 'isMultipleOf3Or5' => true]],
			['!happy!', ['isPrime' => false, 'isHappy' => false, 'isMultipleOf3Or5' => true]],
			['zZ', ['isPrime' => false, 'isHappy' => false, 'isMultipleOf3Or5' => true]],
		];
	}

	/**
	 * @dataProvider wordPropertiesProvider
	 */
	public function testCheckProperties(string $word, array $expectedProperties)
	{
		$wordPropertiesChecker = new WordPropertiesChecker(
			new WordToNumberConverter(),
			new HappyNumberCalculator(),
			new MultipleOf3Or5Strategy(),
		);

		$actualProperties = $wordPropertiesChecker->checkProperties($word);
		$this->assertEquals($expectedProperties, $actualProperties);
	}
}
