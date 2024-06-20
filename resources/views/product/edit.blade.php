@extends('layout')
@section('content')
    <div class="edit-container">
        <div class="edit-form">
            <form action="{{ route('product.update', ['product' => $product->id]) }}" method="POST" class="form">
                @csrf
                @method('PUT')

                <label>Name</label>
                <input name="name" type="text" value="{{ $product->name }}">

                <label>Ammount</label>
                <input name="ammount" type="number" value="{{ $product->ammount }}">

                <label>Price</label>
                <input name="price_per_unit" type="text" value="{{ $product->price_per_unit }}">

                <button type="submit" class="btn btn-success btn-margin">UPDATE</button>
            </form>
        </div>
    </div>

@endsection
