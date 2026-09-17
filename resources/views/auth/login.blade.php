@extends('layouts.app')

@section('content')

<h2>Login</h2>

<form
    method="POST"
    action="{{ route('login.submit') }}"
>

    @csrf

    <label>Email</label>

    <input
        type="email"
        name="email"
        value="{{ old('email') }}"
        required
    >

    <label>Password</label>

    <input
        type="password"
        name="password"
        required
    >

    <button type="submit">
        Login
    </button>

</form>

@endsection