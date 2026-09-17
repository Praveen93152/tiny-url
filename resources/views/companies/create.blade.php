@extends('layouts.app')

@section('content')

<h2>Create Company</h2>

<form
    method="POST"
    action="{{ route('companies.store') }}"
>

    @csrf

    <label>
        Company Name
    </label>

    <input
        type="text"
        name="name"
        value="{{ old('name') }}"
        required
    >

    <button type="submit">
        Create Company
    </button>

</form>

@endsection