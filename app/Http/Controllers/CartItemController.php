<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Services\CartService;
use Inertia\Inertia;
use Inertia\Response;

class CartItemController extends Controller
{
    public function __construct(
        private CartService $cartService = new CartService,
    ) {}

    public function index(): Response
    {
        return Inertia::render('Cart', [
            'cart' => $this->cartService->getCart(),
        ]);
    }

    public function store(Request $request): void
    {
        $this->cartService->increase($request->id);
    }

    public function update(int $id): void
    {
        $this->cartService->decrease($id);
    }

    public function destroy(int $id): void
    {
        CartItem::where([
            'product_id' => $id,
            'user_id' => auth()->id(),
        ])->delete();
    }

    public function clear(): void
    {
        $this->cartService->clear();
    }
}
