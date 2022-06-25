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
            'product' => $product,
        ]);
    }

    public function category($name)
    {
        $products = Category::getCategoryByName($name)->products();
        return self::renderProducts($products, $name);
    }


    public function discount()
    {
        $products = Product::getProductsWithDiscount();
        return self::renderProducts($products, 'Soldes');
    }

    private static function renderProducts($products = null, $title = 'Nos Vêtements')
    {
        $productsList = ($products == null) ? Product::where('status', 'publish')->orderBy('id', 'desc')->where('category_id', '!=', null)->paginate(self::PAGINATION) : $products->where('status', 'publish')->orderBy('id', 'desc')->where('category_id', '!=', null)->paginate(self::PAGINATION);

        if (count($productsList) == 0) {
            abort(404);
        }
        return view('products', [
            'products' => $productsList,
            'title' => strtolower($title)
        ]);
    }
}
