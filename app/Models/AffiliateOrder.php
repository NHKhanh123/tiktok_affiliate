<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AffiliateOrder extends Model
{
    protected $fillable = [
        'product_id',
        'affiliate_link_id',
        'external_order_id',
        'order_amount',
        'currency',
        'order_status',
        'attribution_type',
        'ordered_at',
        'completed_at',
    ];

    protected $casts = [
        'order_amount' => 'decimal:2',
        'ordered_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function affiliateLink(): BelongsTo
    {
        return $this->belongsTo(AffiliateLink::class);
    }

    public function commission(): HasOne
    {
        return $this->hasOne(Commission::class);
    }
}
