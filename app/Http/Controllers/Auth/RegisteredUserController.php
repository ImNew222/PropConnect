<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LandlordDocument;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:landlord,renter'],
            'phone' => ['nullable', 'string', 'max:20'],
        ];

        // Add document validation for landlords
        if ($request->role === 'landlord') {
            $rules['id_document'] = ['required', 'file', 'mimes:jpeg,png,jpg,pdf', 'max:10240'];
        }

        $request->validate($rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'is_verified' => $request->role === 'renter', // Renters are auto-verified
        ]);

        // Handle landlord document upload
        if ($request->role === 'landlord' && $request->hasFile('id_document')) {
            $path = $request->file('id_document')->store('landlord-documents', 'public');
            
            LandlordDocument::create([
                'user_id' => $user->id,
                'document_type' => 'id_proof',
                'document_path' => $path,
                'status' => 'pending',
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        if ($user->isLandlord()) {
            // Redirect to verification pending page or dashboard
            return redirect()->route('landlord.verification.pending');
        }
        
        return redirect('/rental');
    }
}
