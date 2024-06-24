<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Exercises\ExerciseFour\Actions\SubCartItemAction;
use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use App\Exercises\ExerciseFour\Models\CartItem;
use InvalidArgumentException;

class SubCartItemActionTest extends TestCase
{
	public function testExecuteSubtractsQuantityFromCartItem(): void
	{
		$cartMock = $this->createMock(CartInterface::class);
		$cartItemMock = $this->createMock(CartItem::class);

		$cartItemMock->method('getQuantity')->willReturn(5);
		$cartItemMock->expects($this->once())
			->method('setQuantity')
			->with(3);

		$params = [
			'item_key' => 'item_1',
			'sub_quantity' => 2,
		];

		$cartMock->method('getItems')->willReturn(['item_1' => $cartItemMock]);
		$cartMock->expects($this->once())
			->method('setItems')
			->with($this->callback(function ($items) use ($cartItemMock) {
				return isset($items['item_1']) && $items['item_1'] === $cartItemMock;
			}));

		$action = new SubCartItemAction();
		$action->execute($cartMock, $params);
	}

	public function testExecuteRemovesCartItemWhenQuantityBecomesZero(): void
	{
		$cartMock = $this->createMock(CartInterface::class);
		$cartItemMock = $this->createMock(CartItem::class);

		$cartItemMock->method('getQuantity')->willReturn(2);

		$params = [
			'item_key' => 'item_1',
			'sub_quantity' => 2,
		];

		$cartMock->method('getItems')->willReturn(['item_1' => $cartItemMock]);
		$cartMock->expects($this->once())
			->method('setItems')
			->with($this->callback(function ($items) {
				return !isset($items['item_1']);
			}));

		$action = new SubCartItemAction();
		$action->execute($cartMock, $params);
	}

	public function testExecuteThrowsExceptionWhenItemNotFound(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Item item_1 not found');

		$cartMock = $this->createMock(CartInterface::class);
		$params = [
			'item_key' => 'item_1',
			'sub_quantity' => 2,
		];

		$cartMock->method('getItems')->willReturn([]);

		$action = new SubCartItemAction();
		$action->execute($cartMock, $params);
	}

	public function testExecuteThrowsExceptionWhenSubQuantityExceedsCurrentQuantity(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Quantity to be subtracted exceeds the quantity in the cart');

		$cartMock = $this->createMock(CartInterface::class);
		$cartItemMock = $this->createMock(CartItem::class);

		$cartItemMock->method('getQuantity')->willReturn(1);

		$params = [
			'item_key' => 'item_1',
			'sub_quantity' => 2,
		];

		$cartMock->method('getItems')->willReturn(['item_1' => $cartItemMock]);

		$action = new SubCartItemAction();
		$action->execute($cartMock, $params);
	}

	public function testExecuteThrowsExceptionForInvalidParams(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Invalid parameters');

		$cartMock = $this->createMock(CartInterface::class);
		$params = [];

		$action = new SubCartItemAction();
		$action->execute($cartMock, $params);
	}

	public function testExecuteThrowsExceptionForInvalidSubQuantity(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Quantity must be greater than 0');

		$cartMock = $this->createMock(CartInterface::class);
		$params = [
			'item_key' => 'item_1',
			'sub_quantity' => 0,
		];

		$action = new SubCartItemAction();
		$action->execute($cartMock, $params);
	}
}
