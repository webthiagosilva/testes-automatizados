<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Models;

use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use App\Exercises\ExerciseFour\Interfaces\CartItemManagerInterface;
use App\Exercises\ExerciseFour\Interfaces\ItemInterface;
use App\Exercises\ExerciseFour\Interfaces\UserInterface;


class Cart implements CartInterface
{
	private CartItemManagerInterface $itemManager;
	private UserInterface $user;

	public function __construct(UserInterface $user, CartItemManagerInterface $itemManager)
	{
		$this->user = $user;
		$this->itemManager = $itemManager;
	}

	public function getUser(): UserInterface
	{
		return $this->user;
	}

	public function getItems(): array
	{
		return $this->itemManager->getItemsSummary();
	}

	public function getTotalValue(): float
	{
		return $this->itemManager->calculateTotal();
	}

	public function addItems(array $items): void
	{
		$this->itemManager->addItems($items);
	}

	public function addItem(ItemInterface $item, int $quantity): void
	{
		$this->itemManager->addItem($item, $quantity);
	}

	public function subItem(string $itemKey, int $quantity): void
	{
		$this->itemManager->subtractItemQuantity($itemKey, $quantity);
	}

	public function removeItem(string $itemKey): void
	{
		$this->itemManager->removeItem($itemKey);
	}
}
