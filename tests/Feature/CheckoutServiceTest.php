<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Exercises\ExerciseFour\Models\User;
use App\Exercises\ExerciseFour\Services\CheckoutService;
use App\Exercises\ExerciseFour\Interfaces\CartInterface;
use App\Exercises\ExerciseFour\Interfaces\PostalServiceInterface;

class CheckoutServiceTest extends TestCase
{
	public function checkoutProvider(): array
	{
		return [
			'final amount with shipping cost' => [
				'zipCode' => '87180900',
				'totalAmount' => 80.00,
				'shippingCost' => 20.00,
				'expectedFinalAmount' => 100.00
			],
			'final amount without shipping cost' => [
				'zipCode' => '87180900',
				'totalAmount' => 100.00,
				'shippingCost' => 0.00,
				'expectedFinalAmount' => 100.00
			],
		];
	}

	/** @dataProvider checkoutProvider */
	public function testCalculateFinalAmountWithShippingCost(
		string $zipCode,
		float $totalAmount,
		float $shippingCost,
		float $expectedFinalAmount
	): void {
		$userMock = $this->createMock(User::class);
		$userMock->method('getZipCode')->willReturn($zipCode);

		$cartMock = $this->createMock(CartInterface::class);
		$cartMock->method('getUser')->willReturn($userMock);
		$cartMock->method('getTotalAmount')->willReturn($totalAmount);

		$postalServiceMock = $this->createMock(PostalServiceInterface::class);

		if ($totalAmount < CheckoutService::FREE_SHIPPING_THRESHOLD) {
			$postalServiceMock->expects($this->once())
				->method('getShippingCost')
				->with($zipCode)
				->willReturn($shippingCost);
		} else {
			$postalServiceMock->expects($this->never())
				->method('getShippingCost');
		}

		$checkoutService = new CheckoutService($postalServiceMock);
		$finalAmount = $checkoutService->calculateFinalAmount($cartMock);

		$this->assertEquals($expectedFinalAmount, $finalAmount);
	}
}
