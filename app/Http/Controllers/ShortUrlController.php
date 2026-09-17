<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function create()
    {
        if (auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        return view('short_urls.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'original_url' => [
                'required',
                'url',
                'max:2000'
            ],
        ]);

        do {
            $code = Str::random(7);
        } while (
            ShortUrl::where(
                'short_code',
                $code
            )->exists()
        );

        ShortUrl::create([
            'company_id' => $user->company_id,
            'user_id' => $user->id,
            'original_url' => $validated['original_url'],
            'short_code' => $code,
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Short URL created successfully.'
            );
    }
}
