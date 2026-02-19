<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        \App\Services\AlertService::success('Perfil Actualizado', 'Tu información personal ha sido guardada.');
        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Note: Calls to AlertService here might need to be flashed to the *next* request manually if session is invalidated.
        // However, AlertService uses Session::flash. If we invalidate session, we lose it.
        // We should re-flash or use a different approach. But typically 'invalidate' clears everything.
        // Let's rely on the standard behavior or just skip alert for deletion since they are gone.
        // Actually, let's try to flash *after* invalidation if possible, or just accept standard behavior.
        
        return Redirect::to('/');
    }
}
