<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commission extends Model
{
      protected $fillable = [
        'affiliate_order_id',
        'product_id',
        'commission_rate',
        'order_amount',
        'commission_amount',
        'status',
        'settled_at',
    ];

    protected $casts = [
        'commission_rate' => 'decimal:2',
        'order_amount' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'settled_at' => 'datetime',
    ];

    public function affiliateOrder(): BelongsTo
    {
        return $this->belongsTo(AffiliateOrder::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
