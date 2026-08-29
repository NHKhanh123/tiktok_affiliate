<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TikTokAccount extends Model
{
    protected $fillable = [
        'user_id',
        'open_id',
        'access_token',
        'refresh_token',
        'access_token_expires_at',
        'refresh_token_expires_at',
        'scopes',
        'market',
        'is_active',
    ];


    protected function casts(): array
    {
        return [
            'scopes' => 'array',

            'access_token_expires_at' => 'datetime',

            'refresh_token_expires_at' => 'datetime',

            'is_active' => 'boolean',
        ];
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
