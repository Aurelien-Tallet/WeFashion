<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Size;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

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
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required',
        //     'reference' => 'required',
        //     'description' => 'required',
        //     'price' => 'required',
        //     'image' => 'required',
        // ]);

        // dd($request->all());
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'reference' => $request->reference,
            'discount' => $request->discount,
            'category_id' => $request->category,
            'price' => $request->price,
            'status' => $request->status,
        ]);
        foreach ($request->sizes as $size) {
            $product->sizes()->attach($size);
        }

        if ($request->file('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);


            // Get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
            $picture = Picture::create([
                'name' => asset('storage/image/' . $fileNameToStore),
            ]);
            $picture->save();
            $product->picture()->associate($picture);
            $product->save();
        }
        // Else add a dummy image
        else {
            $fileNameToStore = 'oimage.jpg';
        }

        // dd($request->file("image"));
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
        //
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
        //
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'reference' => $request->reference,
            'discount' => $request->discount,
            'category_id' => $request->category,
            'price' => $request->price,
            'status' => $request->status,
        ]);
        // Update the sizes of the product
        $product->sizes()->sync($request->sizes);

        if ($request->file('image') && $product->picture != $request->file('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
            
            // Ignore if no image is uploaded
            if (str_contains($product->picture->name, 'image/')) {
                $deletedFile = '/public/image/' . explode('image/', $product->picture->name)[1];
                Storage::delete($deletedFile);
            }
            
            $product->picture()->update([
                'name' => asset('storage/image/' . $fileNameToStore)
            ]);
        }
        $product->save();
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
