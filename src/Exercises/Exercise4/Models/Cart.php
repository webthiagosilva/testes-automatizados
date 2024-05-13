<?php

declare(strict_types=1);

namespace App\Exercises\Exercise4\Models;

class Cart
{
	public User $user;
	private array $products = [];

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function addProduct(Product $product, int $quantity): void
	{
		if (isset($this->products[$product->name])) {
			$this->products[$product->name]['quantity'] += $quantity;
		} else {
			$this->products[$product->name] = ['product' => $product, 'quantity' => $quantity];
		}
	}

	public function removeProduct(Product $product): void
	{
		unset($this->products[$product->name]);
	}

	public function getTotalValue(): float
	{
		$total = 0;
		foreach ($this->products as $item) {
			$total += $item['product']->price * $item['quantity'];
		}

		return $total;
	}

	public function getProducts(): array
	{
		return $this->products;
	}
}
