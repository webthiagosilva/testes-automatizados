<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Exercises\ExerciseThree\WordToNumberConverter;
use App\Exercises\ExerciseThree\WordPropertiesChecker;
use App\Exercises\ExerciseTwo\HappyNumberCalculator;
use App\Exercises\ExerciseOne\MultipleOf3Or5Strategy;

class WordPropertiesCheckerTest extends TestCase
{
	public function wordPropertiesProvider(): array
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
	public function testCheckProperties(string $word, array $expectedProperties): void
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
