<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

final class ProfileSocialsController
{
    public function update(Request $request): RedirectResponse
    {
        if ($request->user() === null) {
            return abort(404);
        }

        $validated = $request->validate([
            'display_socials' => 'required|boolean',
        ]);

        $request->user()->fill($validated);
        $request->user()->save();

        return Redirect::route('profile.edit');
    }
}
