<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileAvatarUpdateRequest;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Redirect;
use Psr\Log\LoggerInterface;

final class ProfileAvatarController extends Controller
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly Storage $storage)
    {
        //
    }

    public function update(ProfileAvatarUpdateRequest $request): RedirectResponse
    {
        if ($request->user() === null) {
            return Redirect::route('home');
        }

        $request->validated();

        /** @var UploadedFile $file */
        $file = $request->file('avatar');
        $user = $request->user();
        $existingAvatar = $request->user()->avatar;

        if ($existingAvatar !== null) {
            $this->logger->info("Removing existing avatar for user $user->id");
            $this->storage->disk('public')->delete($existingAvatar);
        }

        $this->logger->info("Uploading avatar for user $user->id");

        $hashName = $file->hashName();
        $filePath = "avatars/$hashName";
        $contents = $file->getContent();

        $this->storage->disk('public')->put($filePath, $contents);
        $this->logger->info("Avatar successfully uploaded for user $user->id, updating file path in database");

        $user->avatar = $filePath;
        $user->save();

        $this->logger->info("Avatar successfully saved for user $user->id");

        return Redirect::route('profile.edit');
    }
}
