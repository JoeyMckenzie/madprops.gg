<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function redirect;

final class ProfileSocialsController
{
    public function update(Request $request): RedirectResponse
    {
        if ($request->user() === null) {
            return redirect()->back();
        }

        $validated = $request->validate([
            'x_username' => 'nullable|max:255',
            'linkedin_username' => 'nullable|max:255',
            'github_username' => 'nullable|max:255',
            'pinkary_username' => 'nullable|max:255',
        ]);

        $request->user()->fill($validated);
        $request->user()->save();

        return redirect()->back();
    }
}
