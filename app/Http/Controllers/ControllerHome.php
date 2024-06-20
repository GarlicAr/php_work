<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ControllerHome extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view('home')->with('products', $products);
    }
}
