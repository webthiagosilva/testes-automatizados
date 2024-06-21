<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Actions;

use App\Exercises\ExerciseFour\Interfaces\CartItemActionInterface;
use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use App\Exercises\ExerciseFour\Interfaces\ItemInterface;
use App\Exercises\ExerciseFour\Models\CartItem;
use InvalidArgumentException;

class AddCartItemAction implements CartItemActionInterface
{
	public function execute(CartInterface $cart, array $params): void
	{
		$this->validateParams($params);

		$item = $params['item'];
		$quantity = $params['quantity'];
		$key = $item->getKey();
		$cartItems = $cart->getItems();

		if (isset($cartItems[$key])) {
			$newQuantity = $cartItems[$key]->getQuantity() + $quantity;
			$cartItems[$key]->setQuantity($newQuantity);
		} else {
			$cartItems[$key] = new CartItem($item, $quantity);
		}

		$cart->setItems($cartItems);
	}

	private function validateParams(array $params): void
	{
		if (!isset($params['item']) || !isset($params['quantity'])) {
			throw new InvalidArgumentException('Invalid parameters');
		}

		if ($params['quantity'] < 1) {
			throw new InvalidArgumentException('Quantity must be greater than 0');
		}

		if (!$params['item'] instanceof ItemInterface) {
			throw new InvalidArgumentException('Invalid item');
		}
	}
}
