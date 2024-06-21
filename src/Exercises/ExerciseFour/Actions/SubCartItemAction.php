<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Actions;

use App\Exercises\ExerciseFour\Interfaces\CartItemActionInterface;
use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use InvalidArgumentException;

class SubCartItemAction implements CartItemActionInterface
{
	public function execute(CartInterface $cart, array $params): void
	{
		$this->validateParams($params);

		$key = $params['item_key'];
		$subQuantity = $params['sub_quantity'];
		$cartItems = $cart->getItems();

		if (!isset($cartItems[$key])) throw new InvalidArgumentException("Item {$key} not found");

		$newQuantity = $cartItems[$key]->getQuantity() - $subQuantity;

		if ($newQuantity < 0) throw new InvalidArgumentException('Quantity to be subtracted exceeds the quantity in the cart');

		if ($newQuantity === 0) {
			unset($cartItems[$key]);
		} else {
			$cartItems[$key]->setQuantity($newQuantity);
		}

		$cart->setItems($cartItems);
	}

	private function validateParams(array $params): void
	{
		if (!isset($params['item_key']) || !isset($params['sub_quantity'])) {
			throw new InvalidArgumentException('Invalid parameters');
		}

		if ($params['sub_quantity'] < 1) {
			throw new InvalidArgumentException('Quantity must be greater than 0');
		}
	}
}
