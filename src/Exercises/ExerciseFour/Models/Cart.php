<?php

declare(strict_types=1);

namespace App\Exercises\ExerciseFour\Models;

use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use App\Exercises\ExerciseFour\Interfaces\CartItemActionInterface;
use App\Exercises\ExerciseFour\Actions\AddCartItemAction;
use App\Exercises\ExerciseFour\Actions\SubCartItemAction;
use App\Exercises\ExerciseFour\Actions\RemoveCartItemAction;
use App\Exercises\ExerciseFour\Interfaces\UserInterface;
use Exception;

class Cart implements CartInterface
{
	private UserInterface $user;
	public array $items = [];

	public function __construct(UserInterface $user)
	{
		$this->user = $user;
	}

	public function getUser(): UserInterface
	{
		return $this->user;
	}

	public function getItems(): array
	{
		return $this->items;
	}

	public function setItems(array $items): void
	{
		$this->items = $items;
	}

	public function getTotalAmount(): float
	{
		$total = 0;
		foreach ($this->items as $item) {
			$total += $item->getTotalAmount();
		}
		return round($total, 2);
	}

	public function addItems(array $params): array
	{
		return $this->manageItems(new AddCartItemAction(), $params);
	}

	public function subItems(array $params): array
	{
		return $this->manageItems(new SubCartItemAction(), $params);
	}

	public function removeItems(array $params): array
	{
		return $this->manageItems(new RemoveCartItemAction(), $params);
	}

	private function manageItems(CartItemActionInterface $action, array $params): array
	{
		$result = [];

		if (isset($params[0]) && is_array($params[0])) {
			foreach ($params as $itemParams) {
				$result[] = $this->executeAction($action, $itemParams);
			}
		} else {
			$result[] = $this->executeAction($action, $params);
		}

		return $result;
	}

	private function executeAction(CartItemActionInterface $action, array $params): array
	{
		try {
			$action->execute($this, $params);
			return [
				'status' => 'success',
				'message' => 'Action executed successfully'
			];
		} catch (Exception $e) {
			return [
				'status' => 'error',
				'message' => $e->getMessage()
			];
		}
	}
}
