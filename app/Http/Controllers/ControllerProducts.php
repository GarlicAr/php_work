<?php

namespace App\Http\Controllers;

use App\Models\Enums\Action;
use App\Models\Enums\Type;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use mysql_xdevapi\Exception;
use App\Models\UserActionLogs;


class ControllerProducts extends Controller
{
    protected $actionLoggerController;

    public function __construct(ControllerActionLog $actionLoggerController)
    {
        $this->actionLoggerController = $actionLoggerController;
    }

    public function index()
    {
        //
    }

    public function create(): View
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ammount' => 'required|integer|min:0',
            'price_per_unit' => 'required|numeric|min:0',
        ]);

        $product = Product::create($request->all());

        $this->actionLoggerController->logUserAction(auth()->id(), Action::CREATED, Type::PRODUCT, $product->id, );

        return redirect()->route('home')
            ->with('success', Messages::PRODUCT_CREATED_SUCCESSFULLY);

    }

    public function show($id)
    {
        try {

            $product = Product::findOrFail($id);
            return view('product.show')->with('product', $product);

        }catch (Exception $e){

            return redirect()->route('home')->with('error', $e->getMessage());

        }
    }

    public function edit($id)
    {
        try {

            $product = Product::findOrFail($id);

            return view('product.edit')->with('product', $product);

        }catch (Exception $e){

            return redirect()->route('home')->with('error', $e->getMessage());

        }

    }

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

            $this->actionLoggerController->logUserAction(auth()->id(), Action::UPDATED, Type::PRODUCT, $product->id);

            return redirect()->route('home')
                ->with('success', Messages::PRODUCT_UPDATED_SUCCESSFULLY);

        }catch (Exception $e){

            return redirect()->route('home')->with('error', $e->getMessage());

        }

    }

    public function destroy($id)
    {
        try {

            $product = Product::findOrFail($id);
            $product->delete();

            $this->actionLoggerController->logUserAction(auth()->id(), Action::DELETED, Type::PRODUCT, $product->id);

            return redirect()->route('home')
                ->with('success', Messages::PRODUCT_DELETED_SUCCESSFULLY);
        }catch (Exception $e){

            return redirect()->route('home')->with('error', $e->getMessage());

        }

    }
}
