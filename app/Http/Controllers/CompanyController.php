<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:companies,name'
            ],
        ]);

        Company::create($validated);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Company created successfully.'
            );
    }
}
