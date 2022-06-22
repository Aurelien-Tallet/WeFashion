<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function index()
    {
        $products = Product::paginate(6);
        return view('products', [
            'products' => $products
        ]);
    }
    public function show ($id)
    {
        $product = Product::findOrFail($id);
        return view('product', [
            'product' => $product
        ]);
    }
}
