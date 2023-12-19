<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService = new ProductService,
    ) {}

    public function index(): Response
    {
        return Inertia::render('Products/Index', [
            'products' => Product::all(),
        ]);
    }

    public function create(): Response 
    {
        return Inertia::render('Products/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->productService->createProduct($request->all());
        return redirect()->route('products');
    } 

    public function show(Product $product): Response 
    {
        return Inertia::render('Products/Show', [
            'product' => $product,
        ]);
    } 

    public function edit(Product $product): Response 
    {
        return Inertia::render('Products/Create', [
            'product' => $product,
        ]);
    } 

    public function update(Request $request, Product $product): RedirectResponse 
    {
        $this->productService->updateProduct($request->except('_method'), $product);
        return redirect()->route('products');
    }

    public function destroy(Product $product): RedirectResponse 
    {
        $product->delete();
        return redirect()->route('products');
    } 
}
