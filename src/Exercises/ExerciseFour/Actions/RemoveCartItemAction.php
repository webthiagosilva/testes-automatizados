<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Actions;

use App\Exercises\ExerciseFour\Interfaces\CartItemActionInterface;
use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use InvalidArgumentException;

class RemoveCartItemAction implements CartItemActionInterface
{
	public function execute(CartInterface $cart, array $params): void
	{
		$this->validateParams($params);

		$key = $params['item_key'];
		$cartItems = $cart->getItems();

		if (!isset($cartItems[$key])) {
			throw new InvalidArgumentException("Item {$key} not found");
		}

		unset($cartItems[$key]);

		$cart->setItems($cartItems);
	}

	private function validateParams(array $params): void
	{
		if (!isset($params['item_key'])) {
			throw new InvalidArgumentException('Invalid parameters');
		}
	}
}
