<?php

namespace App\Exercises\Exercise1;

use App\Exercises\Exercise1\Interfaces\MultipleRuleStrategyInterface;

class MultipleSumCalculator
{
    private $strategy;

    public function __construct(MultipleRuleStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function calculateSum(int $limit): int
    {
        $sum = 0;
        for ($number = 0; $number <= $limit; $number++) {
            if ($this->strategy->isMultiple($number)) {
                $sum += $number;
            }
        }

        return $sum;
    }
}
