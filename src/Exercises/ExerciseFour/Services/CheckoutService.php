<?php

namespace App\Exercises\ExerciseFour\Services;

use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use App\Exercises\ExerciseFour\Interfaces\PostalServiceInterface;

class CheckoutService
{
	public const FREE_SHIPPING_THRESHOLD = 100.0;
	private PostalServiceInterface $postalService;

	public function __construct(PostalServiceInterface $postalService)
	{
		$this->postalService = $postalService;
	}

	public function calculateFinalAmount(CartInterface $cart): float
	{
		$total = $cart->getTotalAmount();

		if ($total < self::FREE_SHIPPING_THRESHOLD) {
			$shippingCost = $this->postalService->getShippingCost(
				$cart->getUser()->getZipCode()
			);
			$total += $shippingCost;
		}

		return $total;
	}
}
