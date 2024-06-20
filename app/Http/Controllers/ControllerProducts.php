<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class ControllerProducts extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ammount' => 'required|integer|min:0',
            'price_per_unit' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('home')
            ->with('success', 'Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {

            $product = Product::findOrFail($id);
            return view('product.show') -> with('product', $product);

        }catch (Exception $e){

            return redirect()->route('home')->with('error', $e->getMessage());

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {

            $product = Product::findOrFail($id);
            return view('product.edit')->with('product', $product);

        }catch (Exception $e){

            return redirect()->route('home')->with('error', $e->getMessage());

        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'name' => 'required',
                'ammount' => 'required|integer',
                'price_per_unit' => 'required|numeric|min:0.01',
            ]);

            $product = Product::findOrFail($id);
            $product->update($request->all());

            return redirect()->route('home')
                ->with('success', 'Product updated successfully.');

        }catch (Exception $e){

            return redirect()->route('home')->with('error', $e->getMessage());

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->route('home')
                ->with('success', 'Product deleted successfully.');
        }catch (Exception $e){

            return redirect()->route('home')->with('error', $e->getMessage());

        }

    }
}
