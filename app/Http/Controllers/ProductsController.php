<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests\Products\CreateProductsRequest;
use App\Http\Requests\Products\UpdateProductsRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductsRequest $request, Product $product)
    {
        $product_image = $request->image;
        $product_image_new_name = time(). $product_image->getClientOriginalName();

        $product_image->move('uploads/products', $product_image_new_name);

        $product->image = 'uploads/products/'. $product_image_new_name;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save();

        session()->flash('success', 'Products created successfully.');
        return redirect(route('products.index'));
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
    public function edit(Product $product)
    {
        return view('products.create', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, Product $product)
    {

        if ($request->hasfile('image')){ 
            $product->deleteImage();
            $product_image = $request->image;
            $product_image_new_name = time(). $product_image->getClientOriginalName();

            $product_image->move('uploads/products', $product_image_new_name);
            $product->image = 'uploads/products/'. $product_image_new_name;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->update();
        session()->flash('success', 'Products updated successfully.');
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        
        if(file_exists($product->image)){
            $product->deleteImage();
        }

        $product->delete();
        session()->flash('success', 'Product deleted successfully');
        return redirect()->back();
    }
}
