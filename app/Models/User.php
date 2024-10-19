<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Override;

final class User extends Authenticatable
{
    /**
     * @use HasFactory<UserFactory>
     */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'username',
        'job_title',
        'company_name',
        'bio',
    ];

    protected $appends = [
        'full_name',
        'initials',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return HasMany<Prop, covariant $this>
     */
    public function props(): HasMany
    {
        return $this->hasMany(Prop::class);
    }

    /**
     * @return Attribute<string, string>
     */
    protected function fullName(): Attribute
    {
        return new Attribute(
            get: fn (): string => "$this->first_name $this->last_name"
        );
    }

    /**
     * @return Attribute<string, string>
     */
    protected function initials(): Attribute
    {
        $firstNameInitial = substr($this->first_name, 0, 1);
        $lastNameInitial = substr($this->last_name, 0, 1);

        return new Attribute(
            get: fn (): string => $firstNameInitial.$lastNameInitial
        );
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    #[Override]
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
