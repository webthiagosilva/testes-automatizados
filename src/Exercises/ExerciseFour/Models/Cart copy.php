<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Models;

use App\Exercises\ExerciseFour\Models\CartItem;
use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use App\Exercises\ExerciseFour\Interfaces\ItemInterface;
use App\Exercises\ExerciseFour\Interfaces\UserInterface;

class Cart implements CartInterface
{
	private array $items = [];
	private UserInterface $user;

	public function __construct(UserInterface $user)
	{
		$this->user = $user;
	}

	public function getUser(): UserInterface
	{
		return $this->user;
	}

	public function getItems(): array
	{
		$summary = [];
		foreach ($this->items as $item) {
			$summary[] = [
				'product' => $item->getProduct(),
				'quantity' => $item->getQuantity()
			];
		}
		return $summary;
	}

	public function getTotalValue(): float
	{
		return array_sum(array_map(
			fn ($item) => $item->getQuantity() * $item->getProduct()->getPrice(),
			$this->items
		));
	}

	public function addItems(array $items): void
	{
		foreach ($items as $item) {
			if (
				$item['product'] instanceof ItemInterface
				&& isset($item['quantity'])
			) {
				$this->addItem($item['product'], $item['quantity']);
			}
		}
	}

	public function addItem(ItemInterface $item, int $quantity): void
	{
		$key = $item->getKey();

		if ($quantity <= 0) return;

		if (isset($this->items[$key])) {
			$this->items[$key]->addQuantity($quantity);
		} else {
			$this->items[$key] = new CartItem($item, $quantity);
		}
	}

	public function subItem(string $itemKey, int $quantity): void
	{
		if ($quantity <= 0 || !isset($this->items[$itemKey])) {
			return;
		}

		$this->items[$itemKey]->subtractQuantity($quantity);

		if ($this->items[$itemKey]->getQuantity()  === 0) {
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
