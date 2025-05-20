<?php

namespace App\Http\Controllers;

use App\Models\InactiveRelation;
use Illuminate\Http\Request;

class InactiveRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load inactive relations with related products and missing dependencies
        $relations = InactiveRelation::with(['product', 'missingDependency'])->get();

        return view('inactive_relations.index', compact('relations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InactiveRelation $inactiveRelation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InactiveRelation $inactiveRelation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InactiveRelation $inactiveRelation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InactiveRelation $inactiveRelation)
    {
        //
    }

    public function reactivate(InactiveRelation $inactiveRelation)
    {
        $product = $inactiveRelation->product;
        if ($product) {
            $product->update(['active' => true]);
        }

        $inactiveRelation->delete();

        return redirect()->route('inactive-relations.index')->with('success', 'Product reactivated successfully.');
    }

    public function forceDelete(InactiveRelation $inactiveRelation)
    {
        $product = $inactiveRelation->product;
        if ($product) {
            $product->delete(); // Add this
        }

        $inactiveRelation->delete();

        return redirect()->route('inactive-relations.index')->with('success', 'Inactive relation and product deleted.');
    }


    public function setInactive(InactiveRelation $inactiveRelation)
    {
        $product = $inactiveRelation->product;
        if ($product) {
            $product->update(['active' => false]);
        }

        return redirect()->route('inactive-relations.index')->with('success', 'Product set inactive.');
    }
}
