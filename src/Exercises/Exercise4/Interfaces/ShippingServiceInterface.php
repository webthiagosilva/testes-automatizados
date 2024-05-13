<?php

declare(strict_types=1);

namespace App\Exercises\Exercise4\Interfaces;

interface ShippingServiceInterface
{
	public function calculateShipping(string $zipCode): float;
}
