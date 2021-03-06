<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request as a;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Inertia::render('Products/Index', [
            'filters' => Request::all('search', 'category'),
            'products' => Product::with('category')
                ->filter(Request::only('search', 'category'))
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Products/Create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        
        $inputs = $request->validated();

        if ($request->hasFile('images')) {
            $filename = time() . '_' . $request->images->getClientOriginalName();
            $file = $request->images->storeAs(('images'), $filename);
            $inputs['images'] = $file;
        }
       
        Product::create($inputs);        

        session()->flash('flash.banner', 'Product Created Successfuly');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('products.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Products/Edit', [
            'categories' => Category::all(),
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $inputs = $request->validated();
        
        if ($request->file('images') ? $request->file('images') : null) {
            $filename = $request->images->getClientOriginalName();
            $file = $request->images->storeAs(('images'), $filename);
            $product->images = $file;
        }
         
        $product->name = $inputs['name'];
        $product->category_id = $inputs['category_id'];
        $product->description = $inputs['description'];
        $product->date = $inputs['date']; 
               
        $product->update(array_merge($inputs, ['images' => $product->images]));

        session()->flash('flash.banner', 'Product Updated Successfuly');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('flash.banner', 'Product Deleted Successfuly');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('products.index');
    }
}
