<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function redirect;

final class ProfileDisplaySocialsController
{
    public function update(Request $request): RedirectResponse
    {
        if ($request->user() === null) {
            return redirect()->back();
        }

        $validated = $request->validate([
            'display_socials' => 'required|boolean',
        ]);

        $request->user()->fill($validated);
        $request->user()->save();

        return redirect()->back();
    }
}
