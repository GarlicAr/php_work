@extends('layout')
@section('content')
    <div class="edit-container">
        <div class="edit-form">
            <form action="{{ route('product.store') }}" method="POST" class="form">

                @csrf
                <label>Name</label>
                <input name="name" type="text">

                <label>Ammount</label>
                <input name="ammount" type="number">

                <label>Price</label>
                <input name="price_per_unit" type="text">

                <button type="submit" class="btn btn-success btn-margin">CREATE</button>

            </form>
        </div>
    </div>


@endsection
