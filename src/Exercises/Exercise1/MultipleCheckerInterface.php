<?php

declare(strict_types=1);

namespace App\Exercises\Exercise1;

interface MultipleCheckerInterface
{
	public function isMultiple(int $number): bool;
}
