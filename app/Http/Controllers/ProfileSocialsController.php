<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileSocialsUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

final class ProfileSocialsController extends Controller
{
    public function update(ProfileSocialsUpdateRequest $request): RedirectResponse
    {
        if ($request->user() === null) {
            return Redirect::route('profile.edit');
        }

        $request->user()->fill($request->validated());
        $request->user()->save();

        return Redirect::route('profile.edit');
    }
}
