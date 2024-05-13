<?php

declare(strict_types=1);

namespace App\Exercises\Exercise4\Models;

class Product
{
	public string $name;
	public float $price;

	public function __construct(string $name, float $price)
	{
		$this->name = $name;
		$this->price = $price;
	}
}
