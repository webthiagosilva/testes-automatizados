<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Interfaces;

interface CartItemManagerInterface
{
	public function getItemsSummary(): array;
	public function calculateTotal(): float;
	public function addItems(array $items): void;
	public function addItem(ItemInterface $item, int $quantity): void;
	public function subtractItemQuantity(string $itemKey, int $quantity): void;
	public function removeItem(string $itemKey): void;
}
