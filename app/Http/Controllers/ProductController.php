<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Psr7\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get()->load('delivery');

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store()
    {
        $product = new Product();

        $product->name = request('name');
        $product->size = request('size');
        $product->price = request('price');
        $product->category = request('category');

        $product->save();

        return redirect('/products');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Product $product)
    {
        $product = Product::find($product->id);

        $product->name = request('name');
        $product->size = request('size');
        $product->price = request('price');
        $product->category = request('category');

        $product->save();

        return redirect($product->path());
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/products');
    }
}
