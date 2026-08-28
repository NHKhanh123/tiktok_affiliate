<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawals extends Model
{
     protected $fillable = [
        'amount',
        'bank_name',
        'account_name',
        'account_number',
        'status',
        'requested_at',
        'completed_at',
        'note',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'requested_at' => 'datetime',
        'completed_at' => 'datetime',
    ];
}
