<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Models;

use App\Exercises\ExerciseFour\Interfaces\ItemInterface;
use App\Exercises\ExerciseFour\Interfaces\CartItemInterface;

class CartItem implements CartItemInterface
{
    private ItemInterface $item;
    private int $quantity;

    public function __construct(ItemInterface $item, int $quantity)
    {
        $this->item = $item;
        $this->quantity = max(0, $quantity);
    }

    public function getitem(): ItemInterface
    {
        return $this->item;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function addQuantity(int $quantity): void
    {
        $this->quantity += max(0, $quantity);
    }

    public function subtractQuantity(int $quantity): void
    {
        $this->quantity = max(0, $this->quantity - $quantity);
    }
}
