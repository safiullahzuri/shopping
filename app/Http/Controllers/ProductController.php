<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index')->withProducts($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    public function delete($id){ 
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('success', 'You successfully deleted a product!');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_code' => 'required|unique:products',
            'product_category' => 'required',
            'location_in_shelf' => 'required',
            'brand' => 'required'
        ]);
        

        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_category = $request->product_category;
        $product->location_in_shelf = $request->location_in_shelf;
        $product->brand = $request->brand;
        $product->price_bought = $request->price_bought;
        $product->price_to_be_sold = $request->price_to_be_sold; 

        if($request->hasFile('product_image')){
            $filename = $request->file('product_image')->getClientOriginalName();
            $product->product_image = $filename;
            $request->file('product_image')->storeAs('public/products', $filename);
        }

        if($product->save()){
            return redirect()->route('product')->with('product_added', 'You successfully added a product!');
        }
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
        $product = Product::find($id);
        return view('product.edit')->withProduct($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->product_id;
        $product = Product::find($id);
        $product->update($request->all());
        return redirect()->route('product')->with('success','You successfully updated a product.');
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
        $product->delete();
        return redirect()->back()->with('success', 'You successfully deleted a product.');
    }
}
