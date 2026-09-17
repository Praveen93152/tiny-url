<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;

class RedirectController extends Controller
{
    public function redirect(string $code)
    {
        $shortUrl = ShortUrl::where(
            'short_code',
            $code
        )->firstOrFail();

        $shortUrl->increment('clicks');

        return redirect()->away(
            $shortUrl->original_url
        );
    }
}
