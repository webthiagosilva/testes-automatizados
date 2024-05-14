<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Exercises\ExerciseFour\Models\Cart;
use App\Exercises\ExerciseFour\Models\User;
use App\Exercises\ExerciseFour\Models\Product;

class CartTest extends TestCase
{
	public function cartProvider(): array
	{
		return [
			'empty cart' => [
				'products' => [],
				'expectedTotal' => 0.0
			],
			'one product' => [
				'products' => [
					['product' => new Product('Product 1', 50.0), 'quantity' => 2]
				],
				'expectedTotal' => 100.0
			],
			'multiple products' => [
				'products' => [
					['product' => new Product('Product 1', 50.0), 'quantity' => 1],
					['product' => new Product('Product 2', 75.0), 'quantity' => 1]
				],
				'expectedTotal' => 125.0
			],
			'add existing product' => [
				'products' => [
					['product' => new Product('Product 1', 50.0), 'quantity' => 1],
					['product' => new Product('Product 1', 50.0), 'quantity' => 1]
				],
				'expectedTotal' => 100.0
			]
		];
	}

	/**
	 * @dataProvider cartProvider
	 */
	public function testCart(array $products, float $expectedTotal): void
	{
		$user = new User('John', '12345678');
		$cart = new Cart($user);

		foreach ($products as $product) {
			$cart->addProduct($product['product'], $product['quantity']);
		}

		$this->assertEquals($expectedTotal, $cart->getTotalValue());
	}

	public function testRemoveProduct(): void
	{
		$user = new User('John', '12345678');
		$cart = new Cart($user);
		$product1 = new Product('Product 1', 50.0);
		$product2 = new Product('Product 2', 75.0);

		$cart->addProduct($product1, 2);
		$cart->addProduct($product2, 1);
		$cart->removeProduct($product1);

		$this->assertEquals(75.0, $cart->getTotalValue());
	}

	public function testAddTwoProductsAtOnce(): void
	{
		$user = new User('John', '12345678');
		$cart = new Cart($user);
		$product1 = new Product('Product 1', 50.0);
		$product2 = new Product('Product 2', 75.0);

		$cart->addProduct($product1, 1);
		$cart->addProduct($product2, 1);

		$this->assertEquals(125.0, $cart->getTotalValue());
	}

	public function testAddAndRemoveProductQuantity(): void
	{
		$user = new User('John', '12345678');
		$cart = new Cart($user);
		$product = new Product('Product 1', 50.0);

		$cart->addProduct($product, 2);
		$cart->addProduct($product, -1);

		$this->assertEquals(50.0, $cart->getTotalValue());
	}

	public function testZeroProductQuantity(): void
	{
		$user = new User('John', '12345678');
		$cart = new Cart($user);
		$product = new Product('Product 1', 50.0);

		$cart->addProduct($product, 2);
		$cart->addProduct($product, -2);

		$this->assertEquals(0.0, $cart->getTotalValue());
	}
}
