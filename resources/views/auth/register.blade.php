@extends('layout')
@section('content')
    <div class="login-container-wrap">
        <h2>Register</h2>
        <form class="login-container" action="{{ route('register') }}" method="POST">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="your name" required>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="e-mail" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <button class="btn btn-success btn-margin" type="submit">Register</button>
        </form>
    </div>
@endsection
