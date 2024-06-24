<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Exercises\ExerciseFour\Actions\AddCartItemAction;
use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use App\Exercises\ExerciseFour\Interfaces\ItemInterface;
use App\Exercises\ExerciseFour\Models\CartItem;
use InvalidArgumentException;

class AddCartItemActionTest extends TestCase
{
	public function testExecuteAddsNewItemToCart(): void
	{
		$cartMock = $this->createMock(CartInterface::class);
		$itemMock = $this->createMock(ItemInterface::class);
		$itemMock->method('getKey')->willReturn('item_1');

		$params = [
			'item' => $itemMock,
			'quantity' => 2,
		];

		$cartMock->method('getItems')->willReturn([]);
		$cartMock->expects($this->once())
			->method('setItems')
			->with($this->callback(function ($items) {
				return isset($items['item_1']) && $items['item_1']->getQuantity() === 2;
			}));

		$action = new AddCartItemAction();
		$action->execute($cartMock, $params);
	}

	public function testExecuteUpdatesExistingItemQuantityInCart(): void
	{
		$cartMock = $this->createMock(CartInterface::class);
		$itemMock = $this->createMock(ItemInterface::class);
		$itemMock->method('getKey')->willReturn('item_1');

		$existingCartItem = new CartItem($itemMock, 3);
		$params = [
			'item' => $itemMock,
			'quantity' => 2,
		];

		$cartMock->method('getItems')->willReturn(['item_1' => $existingCartItem]);
		$cartMock->expects($this->once())
			->method('setItems')
			->with($this->callback(function ($items) {
				return isset($items['item_1']) && $items['item_1']->getQuantity() === 5;
			}));

		$action = new AddCartItemAction();
		$action->execute($cartMock, $params);
	}

	public function testExecuteThrowsExceptionForInvalidParams(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Invalid parameters');

		$cartMock = $this->createMock(CartInterface::class);
		$params = [];

		$action = new AddCartItemAction();
		$action->execute($cartMock, $params);
	}

	public function testExecuteThrowsExceptionForInvalidQuantity(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Quantity must be greater than 0');

		$cartMock = $this->createMock(CartInterface::class);
		$itemMock = $this->createMock(ItemInterface::class);

		$params = [
			'item' => $itemMock,
			'quantity' => 0,
		];

		$action = new AddCartItemAction();
		$action->execute($cartMock, $params);
	}

	public function testExecuteThrowsExceptionForInvalidItem(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Invalid item');

		$cartMock = $this->createMock(CartInterface::class);
		$params = [
			'item' => 'not_an_item',
			'quantity' => 2,
		];

		$action = new AddCartItemAction();
		$action->execute($cartMock, $params);
	}
}
