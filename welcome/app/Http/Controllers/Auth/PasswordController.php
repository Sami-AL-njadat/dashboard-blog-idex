<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Flasher\Laravel\Facade\Flasher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
        ], [
            'current_password.required' => 'The current password field is required.',
            'password.required' => 'The new password field is required.',
            'password.confirmed' => 'The new password confirmation does not match.',
            'password.min' => 'The new password must be at least 8 characters.',
        ]);

        if ($validator->fails()) {
            $errorMessage = implode('<br>', $validator->errors()->all());
            return redirect()->back()->with('error', $errorMessage);
        }

        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            Flasher::addError('The provided current password does not match our records.');
            throw ValidationException::withMessages([
                'current_password' => ['The provided current password does not match our records.'],
            ]);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        Flasher::addSuccess('Password updated successfully.');
        Auth::logout();
        return redirect()->route('login');
    }
}