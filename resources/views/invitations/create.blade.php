@extends('layouts.app')

@section('content')

    <h2>Invite User</h2>

    <form method="POST" action="{{ route('invitations.store') }}">

        @csrf

        @if (auth()->user()->isSuperAdmin())
            <label>Company</label>

            <select name="company_id" required>
                <option value="">Select Company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            <input type="hidden" name="role" value="Admin">
        @else
            <label>Role</label>

            <select name="role" required>
                <option value="Member">Member</option>
                <option value="Admin">Admin</option>
            </select>
        @endif

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Submit</button>
    </form>

@endsection
