@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="view-product">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Details</h5>

                    <div class="form-group underline">
                        <label for="productName">Name</label>
                        <p id="productName">{{ $product->name }}</p>
                    </div>

                    <div class="form-group underline">
                        <label for="productAmount">Amount</label>
                        <p id="productAmount">{{ $product->ammount }}</p>
                    </div>

                    <div class="form-group underline">
                        <label for="productPrice">Price</label>
                        <p id="productPrice">€{{ number_format($product->price_per_unit, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
