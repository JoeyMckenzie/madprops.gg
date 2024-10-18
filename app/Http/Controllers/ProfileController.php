<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

final class ProfileController extends Controller
{
    public function show(string $username): Response
    {
        $userWithProps = User::select([
            'first_name',
            'last_name',
            'job_title',
            'company_name',
            'username',
            'bio',
            'avatar',
        ])
            ->where('username', $username)
            ->firstOrFail();

        return Inertia::render('profile/Show', [
            'user' => UserData::from($userWithProps),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        /** @var User|null|MustVerifyEmail $mustVerifyEmail */
        $mustVerifyEmail = $request->user();

        return Inertia::render('profile/Edit', [
            'mustVerifyEmail' => $mustVerifyEmail instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->user() === null) {
            return abort(403);
        }

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user?->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
