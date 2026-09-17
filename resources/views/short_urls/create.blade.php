@extends('layouts.app')

@section('content')

<h2>Create Short URL</h2>

<form
    method="POST"
    action="{{ route('short-urls.store') }}"
>

    @csrf

    <label>
        Original URL
    </label>

    <input
        type="url"
        name="original_url"
        placeholder="https://example.com"
        value="{{ old('original_url') }}"
        required
    >

    @error('original_url')

        <p>{{ $message }}</p>

    @enderror

    <button type="submit">
        Generate Short URL
    </button>

</form>

@endsection