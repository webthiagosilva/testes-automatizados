<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Interfaces;

interface CartItemInterface
{
    public function getItem(): ItemInterface;
    public function getQuantity(): int;
    public function addQuantity(int $quantity): void;
    public function subtractQuantity(int $quantity): void;
}
