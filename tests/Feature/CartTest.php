<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Exercises\ExerciseFour\Models\Cart;
use App\Exercises\ExerciseFour\Models\User;
use App\Exercises\ExerciseFour\Models\Product;
use App\Exercises\ExerciseFour\Services\CartItemManagerService;

class CartTest extends TestCase
{
	/**
	 * @dataProvider cartOperationProvider
	 */
	public function testCartOperations(array $operations, float $expectedTotal): void
	{
		$user = new User('Michael Jackson', '1234567890');
		$cart = new Cart($user, new CartItemManagerService());

		foreach ($operations as $operation) {
			match ($operation['type']) {
				'add' => $cart->addItem(new Product($operation['name'], $operation['price']), $operation['quantity']),
				'sub' => $cart->subItem($operation['itemKey'], $operation['quantity']),
				'adds' => $cart->addItems([
					['item' => new Product($operation['name'], $operation['price']), 'quantity' => $operation['quantity']]
				]),
				'remove' => $cart->removeItem($operation['itemKey']),
			};
		}

		$this->assertEquals($expectedTotal, $cart->getTotalValue());
	}

	public function cartOperationProvider(): array
	{
		return [
			'empty cart' => [
				'operations' => [],
				'expectedTotal' => 0.0
			],
			'add single product' => [
				'operations' => [
					['type' => 'add', 'name' => 'Product 1', 'price' => 50.0, 'quantity' => 2]
				],
				'expectedTotal' => 100.0
			],
			'add multiple products at the same time' => [
				'operations' => [
					['type' => 'adds', 'name' => 'Product 1', 'price' => 50.0, 'quantity' => 2],
					['type' => 'adds', 'name' => 'Product 2', 'price' => 25.0, 'quantity' => 4],
					['type' => 'adds', 'name' => 'Product 3', 'price' => 100.0, 'quantity' => 1]
				],
				'expectedTotal' => 300.0
			],
			'add and remove a product' => [
				'operations' => [
					['type' => 'add', 'name' => 'Product 1', 'price' => 50.0, 'quantity' => 1],
					['type' => 'remove', 'itemKey' => md5('Product 1')]
				],
				'expectedTotal' => 0.0
			],
			'add and subtract quantity' => [
				'operations' => [
					['type' => 'add', 'name' => 'Product 1', 'price' => 50.0, 'quantity' => 3],
					['type' => 'sub', 'itemKey' => md5('Product 1'), 'quantity' => 1]
				],
				'expectedTotal' => 100.0
			],
			'remove non-existing product' => [
				'operations' => [
					['type' => 'remove', 'itemKey' => md5('Product 3')]
				],
				'expectedTotal' => 0.0
			],
			'add and zero out a product' => [
				'operations' => [
					['type' => 'add', 'name' => 'Product 1', 'price' => 50.0, 'quantity' => 2],
					['type' => 'sub', 'itemKey' => md5('Product 1'), 'quantity' => 2]
				],
				'expectedTotal' => 0.0
			]
		];
	}
}
