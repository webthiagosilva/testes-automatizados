<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Interfaces;

interface ItemInterface
{
	public function getKey(): string;
	public function getName(): string;
	public function getPrice(): float;
}
