<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Models;

use App\Exercises\ExerciseFour\Interfaces\UserInterface;

class User implements UserInterface
{
	private string $name;
	private string $zipCode;

	public function __construct(string $name, string $zipCode)
	{
		$this->name = $name;
		$this->zipCode = $zipCode;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getZipCode(): string
	{
		return $this->zipCode;
	}
}
