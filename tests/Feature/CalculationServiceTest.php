<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Exercises\ExerciseFour\User;
use App\Exercises\ExerciseFour\Product;
use App\Exercises\ExerciseFour\Cart;
use App\Exercises\ExerciseFour\ShippingServiceInterface;
use App\Exercises\ExerciseFour\CalculationService;

class CalculationServiceTest extends TestCase
{
	public function calculationProvider(): array
	{
		return [
			'total less than 100 with shipping' => [
				'products' => [
					['product' => new Product('Product 1', 50), 'quantity' => 1]
				],
				'shippingCost' => 20.0,
				'expectedTotal' => 70.0
			],
			'total equal to 100 without shipping' => [
				'products' => [
					['product' => new Product('Product 1', 100), 'quantity' => 1]
				],
				'shippingCost' => 0.0,
				'expectedTotal' => 100.0
			],
			'total greater than 100 without shipping' => [
				'products' => [
					['product' => new Product('Product 1', 100), 'quantity' => 2]
				],
				'shippingCost' => 0.0,
				'expectedTotal' => 200.0
			],
			'empty cart' => [
				'products' => [],
				'shippingCost' => 0.0,
				'expectedTotal' => 0.0
			]
		];
	}

	/**
	 * @dataProvider calculationProvider
	 */
	public function testCalculateFinalValue(array $products, float $shippingCost, float $expectedTotal): void
	{
		$user = new User('John', '12345678');
		$cart = new Cart($user);

		foreach ($products as $product) {
			$cart->addProduct($product['product'], $product['quantity']);
		}

		$shippingService = $this->createMock(ShippingServiceInterface::class);
		$shippingService->method('calculateShipping')->willReturn((float) $shippingCost);

		$calculationService = new CalculationService($shippingService);
		$finalValue = $calculationService->calculateFinalValue($cart);

		$this->assertEquals($expectedTotal, $finalValue);
	}
}
