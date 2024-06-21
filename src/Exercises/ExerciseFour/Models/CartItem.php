<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Models;

use App\Exercises\ExerciseFour\Interfaces\ItemInterface;

class CartItem extends Product
{
    private string $uuid;
    private string $name;
    private float $price;
    private int $quantity;

    public function __construct(ItemInterface $item, int $quantity)
    {
        $this->uuid = $item->getKey();
        $this->name = $item->getName();
        $this->price = $item->getPrice();
        $this->setQuantity($quantity);
    }

    public function getKey(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getTotalAmount(): float
    {
        return $this->price * $this->quantity;
    }
}
