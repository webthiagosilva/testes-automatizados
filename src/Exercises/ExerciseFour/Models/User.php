<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Models;

class User
{
	public string $name;
	public string $zipCode;

	public function __construct(string $name, string $zipCode)
	{
		$this->name = $name;
		$this->zipCode = $zipCode;
	}
}