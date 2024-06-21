<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Exercises\ExerciseFour\Models\Cart;
use App\Exercises\ExerciseFour\Models\User;
use App\Exercises\ExerciseFour\Models\Product;

class CartTest extends TestCase
{
	public function testShouldReturnZeroWhenCartIsEmpty(): void
	{
		$user = new User('Michael Jackson', '87180900');
		$cart = new Cart($user);
		$total = $cart->getTotalAmount();

		$this->assertEquals(0.00, $total);
	}

	public function testShouldBeAbleToAddNewItemsToCartAsExpected(): void
	{
		$user = new User('Michael Jackson', '87180900');
		$cart = new Cart($user);
		$item1 = new Product('Product 1', 100.00);
		$item2 = new Product('Product 2', 50.00);
		$item3 = new Product('Product 3', 10.99);

		$result = $cart->addItems([
			['item' => $item1, 'quantity' => 1],
			['item' => $item2, 'quantity' => 2],
			['item' => $item3, 'quantity' => 3],
		]);

		$this->assertCount(3, $cart->getItems());
		$this->assertNotContains('error', array_column($result, 'status'));
		$this->assertEquals(232.97, $cart->getTotalAmount());
		$this->assertEquals('Product 1', $cart->getItems()[$item1->getKey()]->getName());
		$this->assertEquals('Product 2', $cart->getItems()[$item2->getKey()]->getName());
		$this->assertEquals('Product 3', $cart->getItems()[$item3->getKey()]->getName());
		$this->assertEquals(100.00, $cart->getItems()[$item1->getKey()]->getPrice());
		$this->assertEquals(50.00, $cart->getItems()[$item2->getKey()]->getPrice());
		$this->assertEquals(10.99, $cart->getItems()[$item3->getKey()]->getPrice());
		$this->assertEquals(1, $cart->getItems()[$item1->getKey()]->getQuantity());
		$this->assertEquals(2, $cart->getItems()[$item2->getKey()]->getQuantity());
		$this->assertEquals(3, $cart->getItems()[$item3->getKey()]->getQuantity());
	}

	public function testShouldBeAbleToIncreaseQuantityOfItemsWhenAddingAnExistingItems(): void
	{
		$user = new User('Michael Jackson', '87180900');
		$cart = new Cart($user);
		$item1 = new Product('Product 1', 100.00);
		$item2 = new Product('Product 2', 50.00);
		$item3 = new Product('Product 3', 10.99);

		$result = $cart->addItems([
			['item' => $item1, 'quantity' => 1],
			['item' => $item2, 'quantity' => 2],
			['item' => $item3, 'quantity' => 3],
		]);

		$result = $cart->addItems([
			['item' => $item1, 'quantity' => 2],
			['item' => $item2, 'quantity' => 1],
			['item' => $item3, 'quantity' => 4],
		]);

		$this->assertCount(3, $cart->getItems());
		$this->assertNotContains('error', array_column($result, 'status'));
		$this->assertEquals(526.93, $cart->getTotalAmount());
		$this->assertEquals(3, $cart->getItems()[$item1->getKey()]->getQuantity());
		$this->assertEquals(3, $cart->getItems()[$item2->getKey()]->getQuantity());
		$this->assertEquals(7, $cart->getItems()[$item3->getKey()]->getQuantity());
	}

	public function testShouldBeAbleToSubtractQuantityOfExistingItemsAsExpected(): void
	{
		$user = new User('Michael Jackson', '87180900');
		$cart = new Cart($user);
		$product = new Product('Product Test', 99.99);
		$cart->addItems(
			['item' => $product, 'quantity' => 5],
		);

		$result = $cart->subItems(
			['item_key' => $product->getKey(), 'sub_quantity' => 2]
		);

		$this->assertCount(1, $cart->getItems());
		$this->assertNotContains('error', array_column($result, 'status'));
		$this->assertEquals(299.97, $cart->getTotalAmount());
		$this->assertEquals(3, $cart->getItems()[$product->getKey()]->getQuantity());
	}

	public function testShouldBeAbleToRemoveItemsFromTheCartAsExpected(): void
	{
		$user = new User('Michael Jackson', '87180900');
		$cart = new Cart($user);
		$item1 = new Product('Product 1', 100.00);
		$item2 = new Product('Product 2', 50.00);
		$item3 = new Product('Product 3', 10.99);
		$cart->addItems([
			['item' => $item1, 'quantity' => 1],
			['item' => $item2, 'quantity' => 2],
			['item' => $item3, 'quantity' => 3],
		]);

		$cart->removeItems([
			['item_key' => $item1->getKey()],
			['item_key' => $item3->getKey()],
		]);

		$this->assertCount(1, $cart->getItems());
		$this->assertEquals(100.00, $cart->getTotalAmount());
		$this->assertEquals(2, $cart->getItems()[$item2->getKey()]->getQuantity());
	}

	public function testShouldBeAbleToRemoveProductFromCartIfTheQuantityIsResetAExpected(): void
	{
		$user = new User('Michael Jackson', '87180900');
		$cart = new Cart($user);
		$item1 = new Product('Product 1', 100.00);
		$cart->addItems(
			['item' => $item1, 'quantity' => 5],
		);

		$cart->subItems(
			['item_key' => $item1->getKey(), 'sub_quantity' => 5],
		);

		$this->assertCount(0, $cart->getItems());
		$this->assertEquals(0.00, $cart->getTotalAmount());
	}
}
