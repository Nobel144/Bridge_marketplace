<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        // dd($products);
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => ['required', 'unique:products', 'max:100'],
            'stockQuantity' => ['required'],
            'price' => ['required'],
        ]);
        // Product::create($request->all());
        $product = new Product();
        if($request->file('file') !== null){
            $image = $request->file('file');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'),$imageName);

            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->stockQuantity = $request->stockQuantity;
        $product->price = $request->price;
        $product->description = $request->description;

        $product->save();

        return redirect()->route('products.index')->with('status','product created successfully!' );
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
        $product = Product::find($id);
        // dd($product->name);
        return view('products.edit',compact('product'));
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
        $validatedData = $request->validate([
            'name' => ['required', 'max:100'],
            'stockQuantity' => ['required'],
            'price' => ['required'],
        ]);
        $product = Product::find($id);
        if($request->file('file') !== null){
            $image = $request->file('file');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'),$imageName);

            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->stockQuantity = $request->stockQuantity;
        $product->price = $request->price;
        $product->description = $request->description;

        $product->save();
        return redirect()->route('products.index')->with('status','product updated successfully!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('status','product deleted successfully!' );
    }
}
