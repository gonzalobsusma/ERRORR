<?php

// In CategoryController.php

public function index()
{
    // We'll show all categories and a form to create a new one, all on one page.
    $categories = Category::withCount('products')->latest()->get(); // 'withCount' gets the number of products
    return view('categories.index', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:categories',
    ]);

    Category::create($request->all());

    return redirect()->route('categories.index')
                     ->with('success', 'Category created successfully.');
}

public function destroy(Category $category)
{
    // Note: Because we used `onDelete('set null')` in our migration,
    // deleting a category will not delete the products.
    // It will just set their `category_id` to null.
    $category->delete();

    return redirect()->route('categories.index')
                     ->with('success', 'Category deleted successfully.');

                     public function create()
{
    $categories = Category::all();
    return view('products.create', compact('categories'));
}

Modify the edit() method:

public function edit(Product $product)
{
    $categories = Category::all();
    return view('products.edit', compact('product', 'categories'));
}

Modify the store() and update() methods: We already added category_id to the $fillable array in the Product model, so we just need to add the validation rule. In both store() and update(), add this rule to the validate array:

'category_id' => 'nullable|exists:categories,id', // 'exists' checks if the ID is valid
Example for store():



$request->validate([
    'name' => 'required|string|max:255',
    'description' => 'nullable|string',
    'price' => 'required|numeric|min:0',
    'stock' => 'required|integer|min:0',
    'category_id' => 'nullable|exists:categories,id', // <-- Add this
]);


}
