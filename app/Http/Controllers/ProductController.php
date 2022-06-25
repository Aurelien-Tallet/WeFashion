<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Size;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Nette\NotImplementedException;

class ProductController extends Controller
{

    private const PATH = 'public/image';
    private function storePicture($request)
    {
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        // Get Filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Get just Extension
        $extension = $request->file('image')->getClientOriginalExtension();
        // Filename To store
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $request->file('image')->storeAs(self::PATH, $fileNameToStore);
        $picture = Picture::create([
            'name' => $fileNameToStore
        ]);
        $picture->save();
        return $picture;
    }
    private function updatePicture($request, $product)
    {
        // TODO
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        // Get Filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Get just Extension
        $extension = $request->file('image')->getClientOriginalExtension();
        // Filename To store
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $request->file('image')->storeAs(self::PATH, $fileNameToStore);

        // Ignore if no image is uploaded


        Storage::delete('public/image/' . $product->picture->name);
        $product->picture()->update([
            'name' => $fileNameToStore
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create', ([
            'categories' => Category::all(),
            'sizes' => Size::all(),
            'method' => 'POST',
            'action' => route('admin.products.store'),
            'submit' => 'Ajouter'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request..
        $request->validate([
            'name' => 'required',
            'reference' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        // Create a new product
        $product = Product::create($request->all());
        // Attach size to product
        $product->sizes()->sync($request->sizes);

        // Store picture and associate it to product
        $picture = $this->storePicture($request);
        $product->picture()->associate($picture);


        $product->save();

        return redirect()->route('admin.products.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.products.create', ([
            'categories' => Category::all(),
            'sizes' => Size::all(),
            'method' => 'PUT',
            'action' => route('admin.products.update', $id),
            'product' => Product::findOrFail($id),
            'productSizes' => Product::findOrFail($id)->sizes()->get()->pluck('name', 'id')->toArray(),
            'submit' => 'Modifier'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        // Update the sizes of the product
        $product->sizes()->sync($request->sizes);

        if ($request->file('image') && $product->picture != $request->file('image')) {
            $this->updatePicture($request, $product);
        }
        $product->save();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
