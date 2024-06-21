<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Interfaces;

interface CartInterface
{
	public function getUser(): UserInterface;
	public function getItems(): array;
	public function setItems(array $items): void;
	public function getTotalAmount(): float;
}
