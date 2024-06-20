@extends('layout')
@section('content')
    <div class="login-container-wrap">
        <form class="login-container" action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="e-mail">
            <label for="password">Password</label>
            <input type="password" name="password">
            <button class="btn btn-success btn-margin" type="submit">Login</button>
        </form>


        <p>If not registered <a href="{{ route('register') }}">REGISTER</a></p>
    </div>
@endsection
