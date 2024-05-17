<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Interfaces;

interface CartInterface
{
	public function getUser(): UserInterface;
	public function getItems(): array;
	public function addItem(ItemInterface $item, int $quantity): void;
	public function subItem(string $itemkey,  int $quantity): void;
	public function removeItem(string $itemKey): void;
	public function getTotalValue(): float;
}
