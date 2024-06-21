<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Interfaces;

interface CartItemActionInterface
{
	public function execute(CartInterface $cart, array $params): void;
}
