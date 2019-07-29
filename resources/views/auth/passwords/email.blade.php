@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <email></email>
    </form>
@endsection
