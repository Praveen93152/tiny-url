<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {

            $shortUrls = ShortUrl::with([
                'user',
                'company'
            ])
            ->latest()
            ->get();

        } elseif ($user->isAdmin()) {

            $shortUrls = ShortUrl::with('user')
                ->where('company_id', $user->company_id)
                ->latest()
                ->get();

        } else {

            $shortUrls = ShortUrl::where(
                'user_id',
                $user->id
            )
            ->latest()
            ->get();
        }

        return view(
            'dashboard',
            compact('shortUrls')
        );
    }
}
