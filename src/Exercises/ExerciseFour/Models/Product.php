<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Models;

use App\Exercises\ExerciseFour\Interfaces\ItemInterface;

class Product implements ItemInterface
{
	private string $key;
	private string $name;
	private float $price;

	public function __construct(string $name, float $price)
	{
		$this->key = md5($name);
		$this->name = $name;
		$this->price = $price;
	}

	public function getKey(): string
	{
		return $this->key;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getPrice(): float
	{
		return $this->price;
	}
}
