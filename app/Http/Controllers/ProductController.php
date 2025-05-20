<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['dependencies', 'dependents'])
            ->where('user_id', Auth::id())
            ->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('user_id', Auth::id())->get(); // for selecting dependencies maybe
        return view('products.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'amount_per_minute' => 'required|numeric',
            'started_at' => 'nullable|date',
            'finished_at' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['active'] = true;

        $product = Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $products = Product::where('user_id', Auth::id())->get(); // for dependency selection

        return view('products.edit', compact('product', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'string',
            'description' => 'nullable|string',
            'amount_per_minute' => 'numeric',
            'started_at' => 'nullable|date',
            'finished_at' => 'nullable|date',
            'active' => 'boolean',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->dependents()->exists()) {
            $product->update(['active' => false]);

            foreach ($product->dependents as $dependent) {
                $dependent->update(['active' => false]);
                $dependent->inactiveRelations()->create([
                    'missing_dependency_id' => $product->id,
                ]);
            }

            return redirect()->route('products.index')->with('success', 'Product and dependents marked inactive.');
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }


    public function inactive()
    {
        $products = Product::where('user_id', Auth::id())
            ->where('active', false)
            ->get();

        return view('products.inactive', compact('products'));
    }

    public function dependencies()
    {
        $products = Product::where('user_id', Auth::id())
            ->with('dependencies')
            ->get();

        return view('products.dependencies', compact('products'));
    }
}
