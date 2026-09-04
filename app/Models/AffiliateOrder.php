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
        'affiliate_click_id',

        'tiktok_order_id',
        'tiktok_product_id',
        'tiktok_shop_id',

        'order_amount',
        'product_amount',
        'refund_amount',

        'status',

        'ordered_at',
        'paid_at',
        'completed_at',

        'raw_data',
    ];


    protected $casts = [

        'order_amount' => 'decimal:2',

        'product_amount' => 'decimal:2',

        'refund_amount' => 'decimal:2',

        'ordered_at' => 'datetime',

        'paid_at' => 'datetime',

        'completed_at' => 'datetime',

        'raw_data' => 'array',
    ];


    /*
    |--------------------------------------------------------------------------
    | Product
    |--------------------------------------------------------------------------
    */

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Affiliate Link
    |--------------------------------------------------------------------------
    */

    public function affiliateLink(): BelongsTo
    {
        return $this->belongsTo(
            AffiliateLink::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Click
    |--------------------------------------------------------------------------
    */

    public function affiliateClick(): BelongsTo
    {
        return $this->belongsTo(
            AffiliateClick::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Commission
    |--------------------------------------------------------------------------
    */

    public function commission(): HasOne
    {
        return $this->hasOne(
            Commission::class
        );
    }
}
