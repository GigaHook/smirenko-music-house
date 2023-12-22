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

		foreach (CartItem::where(['user_id' => auth()->id()]) as $cartItem) {
			$product = Product::find($cartItem->product_id);
			$product->quantity = $cartItem->quantity;
			$cart['items'][] = $product;
			$cart['total'] += $product->price * $product->quantity;
			$cart['totalItems'] += $product->quantity;
		}

		return $cart;
	}

	public function increase(int $id): void
	{
		//TODO хз чёто
		$cartItem = CartItem::where([
			'user_id' => auth()->id(),
			'product_id' => $id,
		])->all();

		if (!$cartItem) {
			$cartItem = CartItem::create([
				'user_id' => auth()->id(),
				'product_id' => $id,
				'quantity' => 0,
			]);
		}

		$cartItem->quantity++;
		$cartItem->save();

		//$cartItem = CartItem::firstOrCreate([
		//	'user_id' => auth()->id(),
		//	'product_id' => $id,
		//], [
		//	'quantity' => 0,
		//]);
		//
		//dd($cartItem);
//
		//$cartItem->quantity++;
		//$cartItem->save();
	}

	public function decrease(int $id): void 
	{
		$cartItem = CartItem::where([
			'user_id' => auth()->id(),
			'product_id' => $id,
		]);

		if ($cartItem->quantity == 1) {
			$cartItem->delete();
		} else {
			$cartItem->quantity--;
			$cartItem->save();
		}
	}

	public function clear(): void
	{
		CartItem::where(['user_id' => auth()->id()])->delete();
	}
}