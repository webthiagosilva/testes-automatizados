<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Interfaces;

interface PostalServiceInterface
{
    public function getShippingCost(string $zipCode): float;
}
