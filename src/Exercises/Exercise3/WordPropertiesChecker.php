<?php

declare(strict_types=1);

namespace App\Exercises\Exercise3;

use App\Common\NumberUtil;
use App\Exercises\Exercise1\MultipleOf3Or5Strategy;
use App\Exercises\Exercise2\HappyNumberCalculator;

class WordPropertiesChecker
{
	private WordToNumberConverter $converter;
	private HappyNumberCalculator $happyChecker;
	private MultipleOf3Or5Strategy $multipleChecker;

	public function __construct(
		WordToNumberConverter $converter,
		HappyNumberCalculator $happyChecker,
		MultipleOf3Or5Strategy $multipleChecker
	) {
		$this->converter = $converter;
		$this->happyChecker = $happyChecker;
		$this->multipleChecker = $multipleChecker;
	}

	public function checkProperties(string $word): array
	{
		$isPrime = false;
		$isHappy = false;
		$isMultipleOf3Or5 = false;

		$wordValue = $this->converter->convertToNumber($word);

		if ($wordValue !== 0) {
			$isPrime = NumberUtil::isPrime($wordValue);
			$isHappy = $this->happyChecker->isHappy($wordValue);
			$isMultipleOf3Or5 = $this->multipleChecker->isMultiple($wordValue);
		}

		return [
			'isPrime' => $isPrime,
			'isHappy' => $isHappy,
			'isMultipleOf3Or5' => $isMultipleOf3Or5,
		];
	}
}
