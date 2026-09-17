@extends('layouts.app')

@section('content')

<h1>Dashboard</h1>

<p>
    Welcome,
    <strong>{{ auth()->user()->name }}</strong>
</p>

<p>
    Role:
    <strong>{{ auth()->user()->role }}</strong>
</p>

@if(auth()->user()->company)

<p>
    Company:
    <strong>
        {{ auth()->user()->company->name }}
    </strong>
</p>

@endif


<h2>Short URLs</h2>

@if($shortUrls->count() === 0)

    <p>No short URLs found.</p>

@else

<table>

    <thead>

        <tr>

            <th>ID</th>

            @if(auth()->user()->isSuperAdmin())
                <th>Company</th>
                <th>User</th>
            @endif

            <th>Original URL</th>

            <th>Short URL</th>

            <th>Clicks</th>

            <th>Created</th>

        </tr>

    </thead>

    <tbody>

    @foreach($shortUrls as $url)

        <tr>

            <td>
                {{ $url->id }}
            </td>

            @if(auth()->user()->isSuperAdmin())

                <td>
                    {{ $url->company->name }}
                </td>

                <td>
                    {{ $url->user->name }}
                </td>

            @endif

            <td>

                <a
                    href="{{ $url->original_url }}"
                    target="_blank"
                >
                    {{ $url->original_url }}
                </a>

            </td>

            <td>

                <a
                    href="{{ url('/s/' . $url->short_code) }}"
                    target="_blank"
                >
                    {{ url('/s/' . $url->short_code) }}
                </a>

            </td>

            <td>
                {{ $url->clicks }}
            </td>

            <td>
                {{ $url->created_at->format('Y-m-d H:i') }}
            </td>

        </tr>

    @endforeach

    </tbody>

</table>

@endif

@endsection