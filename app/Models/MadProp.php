<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\MadPropFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class MadProp extends Model
{
    /** @use HasFactory<MadPropFactory> */
    use HasFactory;

    protected $fillable = [
        'giver_id',
        'receiver_id',
        'message',
        'display',
        'position',
    ];

    /**
     * @return BelongsTo<User, covariant $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<User, covariant $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'giver_id');
    }

    /**
     * @return BelongsTo<User, covariant MadProp>
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
