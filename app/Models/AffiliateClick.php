<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AffiliateClick extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'affiliate_link_id',
        'session_id',
        'ip_address',
        'user_agent',
        'referer',
        'clicked_at',
    ];

    protected $casts = [
        'clicked_at' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function affiliateLink(): BelongsTo
    {
        return $this->belongsTo(AffiliateLink::class);
    }

    public function affiliateOrder()
    {
        return $this->hasOne(AffiliateOrder::class);
    }
}
