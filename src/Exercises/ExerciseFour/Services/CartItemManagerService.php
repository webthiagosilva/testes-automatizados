<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Services;

use App\Exercises\ExerciseFour\Interfaces\CartItemManagerInterface;
use App\Exercises\ExerciseFour\Interfaces\ItemInterface;
use App\Exercises\ExerciseFour\Models\CartItem;

class CartItemManagerService implements CartItemManagerInterface
{
	private array $items = [];

	public function getItemsSummary(): array
	{
		return array_map(function ($item) {
			return [
				'name' => $item->getItem()->getName(),
				'price' => $item->getItem()->getPrice(),
				'quantity' => $item->getQuantity(),
				'total' => $item->getItem()->getPrice() * $item->getQuantity()
			];
		}, $this->items);
	}

	public function calculateTotal(): float
	{
		return array_sum(array_map(
			fn ($item) => $item->getItem()->getPrice() * $item->getQuantity(),
			$this->items
		));
	}

	public function addItems(array $items): void
	{
		foreach ($items as $item) {
			if (
				$item['item'] instanceof ItemInterface
				&& isset($item['quantity'])
			) {
				$this->addItem($item['item'], $item['quantity']);
			}
		}
	}

	public function addItem(ItemInterface $item, int $quantity): void
	{
		$key = $item->getKey();

		if ($quantity <= 0) {
			return;
		}

		if (isset($this->items[$key])) {
			$this->items[$key]->addQuantity($quantity);
		} else {
			$this->items[$key] = new CartItem($item, $quantity);
		}
	}

	public function subtractItemQuantity(string $itemKey, int $quantity): void
	{
		if ($quantity <= 0 || !isset($this->items[$itemKey])) {
			return;
		}

		$this->items[$itemKey]->subtractQuantity($quantity);

		if ($this->items[$itemKey]->getQuantity() === 0) {
			$this->removeItem($itemKey);
		}
	}

	public function removeItem(string $itemKey): void
	{
		if (isset($this->items[$itemKey])) {
			unset($this->items[$itemKey]);
		}
	}
}
