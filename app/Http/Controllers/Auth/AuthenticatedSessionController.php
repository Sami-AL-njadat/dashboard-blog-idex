<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Flasher\Laravel\Facade\Flasher;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\ValidationException;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('page.authraization.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {

        
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
        ]);




        if ($validator->fails()) {
            $errorMessage = implode('<br>', $validator->errors()->all());
            return redirect()->back()->with('error', $errorMessage);
        }



        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            Flasher::addError('The provided email does not match our records.');
            throw ValidationException::withMessages([
                'email' => ['The provided email does not match our records.'],
            ]);
        }

        if (!Auth::attempt(
            ['email' => $request->input('email'), 'password' => $request->input('password')],
            $request->filled('remember')
        )) {
            Flasher::addError('The provided password does not match our records.');
            throw ValidationException::withMessages([
                'password' => ['The provided password does not match our records.'],
            ]);
        }

        $request->session()->regenerate();

        Flasher::addSuccess('Welcome ' . $user->name);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}