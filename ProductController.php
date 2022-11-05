<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return view('admin.product.index',compact('products'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     *@return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',  //jegula mendatory item segula require korte hoy
            'price'=> 'required',
            'quantity'=> 'required',
            'category_id'=> 'required'
             
        ]);

    Product::create([
      'name' => $request->name,
      'slug'=>Str::slug($request->name),
       'price'=>$request->price,
       'quantity'=>$request->quantity,
       'category_id'=>$request->category_id,
       'status'=>$request->status,
       'image'=>null,
       'description'=>$request->description


    ]);
    
        return redirect()->back()->with('success','Product Created Successfully.');
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

        $product=Product::find($id);
        $categories=Category::all();
        return view('admin.product.edit',compact('product', 'categories'));
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
        $request->validate([
            'name'=> 'required',  //jegula mendatory item segula require korte hoy
            'price'=> 'required',
            'quantity'=> 'required',
            'category_id'=> 'required'
             
        ]);

    $product=Product::find($id);
     $product->name = $request->name;
     $product->slug=Str::slug($request->name);
     $product->price=$request->price;
     $product->quantity=$request->quantity;
     $product->category_id=$request->category_id;
     $product->status =$request->status;
     $product->description=$request->description;


    $product->update();
    return redirect()->back()->with('success','Product Updated Successfully.');
    
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
        
            return redirect()->back()->with('success','Product Deleted Successfully.');
    
    }
}
