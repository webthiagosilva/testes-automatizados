<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour;

interface ShippingServiceInterface
{
	public function calculateShipping(string $zipCode): float;
}
