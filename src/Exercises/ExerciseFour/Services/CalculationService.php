<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Services;

use App\Exercises\ExerciseFour\Models\Cart;
use App\Exercises\ExerciseFour\Interfaces\ShippingServiceInterface;

class CalculationService
{
	private ShippingServiceInterface $shippingService;

	public function __construct(ShippingServiceInterface $shippingService)
	{
		$this->shippingService = $shippingService;
	}

	public function calculateFinalValue(Cart $cart): float
	{
		$totalValue = $cart->getTotalValue();

		if ($totalValue < 100) {
			$shipping = $this->shippingService->calculateShipping($cart->user->zipCode);
			$totalValue += $shipping;
		}

		return $totalValue;
	}
}
