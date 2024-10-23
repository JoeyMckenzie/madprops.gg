<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\MadPropData;
use App\Data\UserData;
use App\Http\Requests\Profile\ProfileInformationUpdateRequest;
use App\Models\MadProp;
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
        $user = User::select([
            'id',
            'first_name',
            'last_name',
            'job_title',
            'company_name',
            'username',
            'bio',
            'avatar',
            'display_socials',
            'pinkary_username',
            'github_username',
            'linkedin_username',
            'x_username',
        ])
            ->where('username', $username)
            ->firstOrFail();

        $userProps = MadProp::with('author')
            ->where('receiver_id', $user->id)
            ->where('display', true)
            ->orderBy('position')
            ->get();

        $userPropsData = $userProps->map(fn (MadProp $prop): MadPropData => MadPropData::from($prop));

        return Inertia::render('profile/Show', [
            'user' => UserData::from($user),
            'madProps' => $userPropsData,
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
    public function update(ProfileInformationUpdateRequest $request): RedirectResponse
    {
        if ($request->user() === null) {
            return Redirect::route('home');
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
