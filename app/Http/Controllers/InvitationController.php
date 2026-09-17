<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class InvitationController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {

            $companies = Company::orderBy('name')->get();

        } else {

            $companies = collect([
                $user->company
            ]);
        }

        return view(
            'invitations.create',
            compact('companies')
        );
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'=>['required','string','max:255'],
            'password'=>['required','string','min:8','confirmed'],
            'email' => ['required','email'],
            'role' => ['required','in:Admin,Member'],
            'company_id' => ['nullable','exists:companies,id'],
        ]);

        if ($user->isSuperAdmin()) {

            $request->validate([
                'company_id' => [
                    'required',
                    'exists:companies,id'
                ],
            ]);

            $companyId = $validated['company_id'];

        } else {
    
            $companyId = $user->company_id;
        
            // Admin cannot invite into another company

            if (!empty($validated['company_id']) && $validated['company_id'] != $companyId) {
                abort(403);
            }
        }
      

        //check user is exist or not
        if (User::where('email',$validated['email'])->exists()) {
            // dd('check');
            return back()->withErrors([
                'email' => 'User already exists.'
            ]);
        }

        $newUser=User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password']),
            'role'=>$validated['role'],
            'company_id'=>$companyId
        ]);
     

        $invitation = Invitation::create([
            'invited_by' => $user->id,
            'invited_to'=>$newUser->id
        ]);

        return back()->with(
            'success',
            'User is created '
        );
    }
}
