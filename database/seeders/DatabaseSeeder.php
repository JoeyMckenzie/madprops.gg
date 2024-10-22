<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\MadProp;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

final class DatabaseSeeder extends Seeder
{
    private const int RANDOM_PROPS_AMOUNT = 20;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $testUser = User::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'username' => 'test.user',
            'email_verified_at' => now(),
            'bio' => fake()->text(255),
            'company_name' => fake()->company(),
            'job_title' => fake()->jobTitle(),
            'avatar' => fake()->imageUrl(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        /** @var Collection<int, User> $users */
        $users = User::factory(20)->create();

        // Ensure each user gives and receives at least one prop
        foreach ($users as $giver) {
            $receiver = $users->except([$giver->id])->random();

            MadProp::create([
                'giver_id' => $giver->id,
                'receiver_id' => $receiver->id,
                'display' => true,
                'position' => random_int(1, 5),
                'message' => fake()->sentences(asText: true),
            ]);
        }

        // Add some additional random props
        for ($i = 0; $i < self::RANDOM_PROPS_AMOUNT; $i++) {
            $giver = $users->random();
            $receiver = $users->except([$giver->id])->random();

            MadProp::create([
                'giver_id' => $giver->id,
                'receiver_id' => $receiver->id,
                'display' => (bool) random_int(0, 1),
                'position' => random_int(1, 5),
                'message' => fake()->sentences(asText: true),
            ]);
        }

        $otherUser = User::whereKeyNot($testUser->id)->first();
        assert($otherUser !== null);
        MadProp::create([
            'giver_id' => $otherUser->id,
            'receiver_id' => $testUser->id,
            'display' => true,
            'position' => 1,
            'message' => fake()->sentences(asText: true),
        ]);
    }
}
