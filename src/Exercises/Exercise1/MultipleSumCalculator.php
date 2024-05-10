<?php

declare(strict_types=1);

namespace App\Exercises\Exercise1;

use App\Exercises\Exercise1\MultipleCheckerInterface;

class MultipleSumCalculator
{
    private const LIMIT = 1000;

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
