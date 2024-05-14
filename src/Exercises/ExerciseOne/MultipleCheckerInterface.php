<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseOne;

interface MultipleCheckerInterface
{
	public function isMultiple(int $number): bool;
}
