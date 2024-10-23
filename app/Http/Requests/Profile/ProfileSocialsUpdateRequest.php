<?php

declare(strict_types=1);

namespace App\Http\Requests\Profile;

use App\Http\Rules\SocialProfileUsernameRule;
use Illuminate\Foundation\Http\FormRequest;

final class ProfileSocialsUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, SocialProfileUsernameRule|string>|string>
     */
    public function rules(): array
    {
        return [
            'display_socials' => 'required|boolean',
            'x_username' => ['nullable', new SocialProfileUsernameRule],
            'linkedin_username' => ['nullable', new SocialProfileUsernameRule],
            'github_username' => ['nullable', new SocialProfileUsernameRule],
            'pinkary_username' => ['nullable', new SocialProfileUsernameRule],
        ];
    }
}
