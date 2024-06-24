<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Exercises\ExerciseFour\Actions\RemoveCartItemAction;
use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use InvalidArgumentException;

class RemoveCartItemActionTest extends TestCase
{
	public function testExecuteRemovesCartItem(): void
	{
		$cartMock = $this->createMock(CartInterface::class);

		$params = ['item_key' => 'item_1'];

		$cartMock->method('getItems')->willReturn(['item_1' => 'cart_item']);
		$cartMock->expects($this->once())
			->method('setItems')
			->with($this->callback(function ($items) {
				return !isset($items['item_1']);
			}));

		$action = new RemoveCartItemAction();
		$action->execute($cartMock, $params);
	}

	public function testExecuteThrowsExceptionWhenItemNotFound(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Item item_1 not found');

		$cartMock = $this->createMock(CartInterface::class);
		$params = ['item_key' => 'item_1'];

		$cartMock->method('getItems')->willReturn([]);

		$action = new RemoveCartItemAction();
		$action->execute($cartMock, $params);
	}

	public function testExecuteThrowsExceptionForInvalidParams(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Invalid parameters');

		$cartMock = $this->createMock(CartInterface::class);
		$params = [];

		$action = new RemoveCartItemAction();
		$action->execute($cartMock, $params);
	}
}
