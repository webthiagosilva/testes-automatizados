<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseOne;

use App\Exercises\ExerciseOne\MultipleCheckerInterface;

class MultipleSumCalculator
{
    public const LIMIT = 1000;

    private MultipleCheckerInterface $multipleChecker;

    public function __construct(MultipleCheckerInterface $multipleCheckerInterface)
    {
        $this->multipleChecker = $multipleCheckerInterface;
    }

    public function calculateSum(): int
    {
        $sum = 0;
        for ($number = 0; $number <= self::LIMIT; $number++) {
            if ($this->multipleChecker->isMultiple($number)) {
                $sum += $number;
            }
        }

        return $sum;
    }
}
