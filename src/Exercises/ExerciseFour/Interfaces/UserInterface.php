<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Interfaces;

interface UserInterface
{
	public function getName(): string;
	public function getZipCode(): string;
}
