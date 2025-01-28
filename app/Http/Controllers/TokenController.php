<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class TokenController extends Controller
{
    // Zeigt die Token-Generierungsseite
    public function showTokenGenerator()
    {
        return view('token-generator'); // Zeigt die oben erstellte Blade-Ansicht an
    }

    // Verarbeitung der Token-Generierung
    public function generateToken(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'token_all' => 'nullable|boolean',
            'token_single' => 'nullable|boolean',
        ]);

        $user = \App\Models\User::find($request->user_id);

        // Logik: Ist "Login All" ausgewählt
        if ($request->filled('token_all')) {
            $token = $user->createToken('login-all')->plainTextToken;
        }

        // Logik: Ist "Login Single" ausgewählt
        if ($request->filled('token_single')) {
            $token = $user->createToken('login-single')->plainTextToken;
        }

        return back()->with('success', "Token generated: $token");
    }
}
