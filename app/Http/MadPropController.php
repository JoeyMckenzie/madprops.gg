<?php

declare(strict_types=1);

namespace App\Http;

use App\Data\UserData;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Psr\Log\LoggerInterface;
use Request;

final class MadPropController extends Controller
{
    public function __construct(private readonly LoggerInterface $logger) {}

    public function create(string $username): Response
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

        return Inertia::render('mad-props/Create', [
            'user' => UserData::from($user),
        ]);
    }

    public function store(Request $request, string $username): RedirectResponse
    {
        $this->logger->info("Creating prop for $username");

        return Redirect::route('profile.show', $username);
    }
}
