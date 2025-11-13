<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          // Fetch all products, get the latest ones first, and paginate
    $products = Product::latest()->paginate(10); 

    // Return the view and pass the $products variable to it
    return view('products.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           $categories = Category::all();
    return view('products.create', compact('categories'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    // 1. Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    // 2. Create the new product using the $fillable fields
    Product::create($request->all());

    // 3. Redirect back to the product list with a success message
    return redirect()->route('products.index')
                     ->with('success', 'Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
         // 'Product $product' is Route-Model Binding.
    // Laravel automatically finds the Product with the ID from the URL.
    return view('products.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
         // Route-Model Binding automatically fetches the product.
        $categories = Category::all();
    return view('products.edit', compact('product', 'categories'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
