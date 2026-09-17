<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>URL Shortener</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
        }

        nav {
            background: #222;
            color: white;
            padding: 15px 30px;
        }

        nav a {
            color: white;
            margin-right: 20px;
            text-decoration: none;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            background: white;
            padding: 30px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .success {
            background: #d4edda;
            padding: 15px;
            margin-bottom: 20px;
        }

        .error {
            background: #f8d7da;
            padding: 15px;
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

<nav>

    <a href="{{ route('dashboard') }}">
        Dashboard
    </a>

    @auth

        @if(auth()->user()->isAdmin() ||
            auth()->user()->isMember())

            <a href="{{ route('short-urls.create') }}">
                Create Short URL
            </a>

        @endif

        @if(auth()->user()->isSuperAdmin())

            <a href="{{ route('companies.create') }}">
                Create Company
            </a>

        @endif

        @if(auth()->user()->isSuperAdmin() ||
            auth()->user()->isAdmin())

            <a href="{{ route('invitations.create') }}">
                Invite User
            </a>

        @endif

        <form
            action="{{ route('logout') }}"
            method="POST"
            style="display:inline"
        >

            @csrf

            <button type="submit">
                Logout
            </button>

        </form>

    @endauth

</nav>


<div class="container">

    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="error">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    @yield('content')

</div>

</body>

</html>