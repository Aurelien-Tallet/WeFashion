<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    private const PAGINATION = 6;

    public function index()
    {
        return self::renderProducts();
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        if($product->status == 'unpublish') {
            return abort(404);
            return redirect()->route('products');
        }

        return view('product', [
            'product' => $product
        ]);
    }

    public function category($name)
    {
        $products = Category::getCategoryByName($name)->products();
        return self::renderProducts($products);
    }


    public function discount()
    {
        $products = Product::getProductsWithDiscount();
        return self::renderProducts($products);
    }

    private static function renderProducts($products = null)
    {
        $productsList = ($products == null) ? Product::where('status', 'publish')->paginate(self::PAGINATION) : $products->where('status', 'publish')->paginate(self::PAGINATION);

        if (count($productsList) == 0) {
            abort(404);
        }
        return view('products', [
            'products' => $productsList
        ]);
    }
}
