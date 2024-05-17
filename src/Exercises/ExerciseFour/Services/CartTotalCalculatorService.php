<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Services;

use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use App\Exercises\ExerciseFour\Interfaces\ShippingServiceInterface;

class CartTotalCalculatorService {
	private const FREE_SHIPPING_THRESHOLD = 100.0;
	private ShippingServiceInterface $shippingService;

	public function __construct(ShippingServiceInterface $shippingService) {
		$this->shippingService = $shippingService;
	}

	public function calculateTotal(CartInterface $cart): float {
		$total = $cart->getTotalValue();

		if ($total < self::FREE_SHIPPING_THRESHOLD) {
			$freightCost = $this->shippingService->calculateShippingCost(
				$cart->getUser()->getZipCode()
			);
			$total += $freightCost;
		}

		return $total;
	}
}
