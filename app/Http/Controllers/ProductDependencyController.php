<?php

namespace App\Http\Controllers;

use App\Models\ProductDependency;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductDependencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dependencies = \App\Models\ProductDependency::with(['product', 'dependency'])->get();

        return view('dependencies.index', compact('dependencies'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('dependencies.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'depends_on_id' => 'required|exists:products,id|different:product_id',
        ]);

        ProductDependency::create($validated);

        $exists = ProductDependency::where('product_id', $request->product_id)
            ->where('depends_on_id', $request->depends_on_id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['This dependency already exists.']);
        }

        return redirect()->route('dependencies.index')->with('success', 'Dependency created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductDependency $productDependency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductDependency $productDependency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductDependency $productDependency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductDependency $productDependency)
    {
        //
    }
}
