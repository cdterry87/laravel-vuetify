@extends('layouts.auth')

@section('content')
    <div id="welcome">
        <div class="content">
            <div class="title">
                {{ config('app.name', 'Laravel') }}
                <div class="subtitle">
                    Something interesting about this site!
                </div>
            </div>
            <div class="links">
                @auth
                    <button-link href="{{ url('home') }}">Get Started!</button-link>
                @else
                    @if (Route::has('login'))
                        <button-link href="{{ route('login') }}">Login</button-link>
                    @endif
                    @if (Route::has('register'))
                        <button-link href="{{ route('register') }}">Register</button-link>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endsection
