<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;

class CartService 
{
	public function getCart(): array
	{
		$cart = [
			'items' => [],
			'total' => 0,
			'totalItems' => 0,
		];

		foreach (auth()->user()->products as $product) {
			$cart['items'][] = $product;
			$cart['total'] += $product->price * $product->cartItem->quantity;
			$cart['totalItems'] += $product->cartItem->quantity;
		}

		return $cart;
	}

	public function increase(int $id): void
	{
		$cartItem = CartItem::firstOrNew([
			'user_id' => auth()->id(),
			'product_id' => $id,
		]);

		$cartItem->quantity++;
		$cartItem->save();
	}

	public function decrease(int $id): void 
	{
		$cartItem = CartItem::firstWhere([
			'user_id' => auth()->id(),
			'product_id' => $id,
		]);

		$cartItem->quantity--;
		$cartItem->quantity == 0 
			? $cartItem->delete()
			: $cartItem->save();

	}

	public function clear(): void
	{
		CartItem::where(['user_id' => auth()->id()])->delete();
	}
}