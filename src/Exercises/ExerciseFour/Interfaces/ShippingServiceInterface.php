<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Interfaces;

interface ShippingServiceInterface
{
    public function calculateShippingCost(string $zipCode): float;
}
