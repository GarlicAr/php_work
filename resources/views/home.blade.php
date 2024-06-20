@extends('layout')

@section('content')
    <div class="product-table">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Preces nosaukums</th>
                <th scope="col">Daudzums</th>
                <th scope="col">Cena</th>
                <th scope="col">Darbibas</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->ammount }}</td>
                    <td>€ {{ $product->price_per_unit }}</td>
                    <td>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endif
                        <a href="{{route('product.show', $product->id)}}" class="btn btn-sm btn-primary">View</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(auth()->user()->is_admin)
            <div class="add-new-container">
                <form action="{{ route('product.create') }}" method="GET">
                    <button type="submit" class="btn btn-margin btn-success">CREATE NEW</button>
                </form>
            </div>
        @endif
    </div>
@endsection
