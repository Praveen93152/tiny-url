@extends('layouts.app')

@section('content')

<h2>Accept Invitation</h2>

<p>
    Email:
    <strong>
        {{ $invitation->email }}
    </strong>
</p>

<p>
    Role:
    <strong>
        {{ $invitation->role }}
    </strong>
</p>

<p>
    Company:
    <strong>
        {{ $invitation->company->name }}
    </strong>
</p>


<form
    method="POST"
    action="{{ route(
        'invitations.complete',
        $token
    ) }}"
>

    @csrf

    <label>
        Name
    </label>

    <input
        type="text"
        name="name"
        required
    >


    <label>
        Password
    </label>

    <input
        type="password"
        name="password"
        required
    >


    <label>
        Confirm Password
    </label>

    <input
        type="password"
        name="password_confirmation"
        required
    >


    <button type="submit">
        Create Account
    </button>

</form>

@endsection