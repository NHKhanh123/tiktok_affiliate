<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'sale_price',
        'tiktok_product_id',
        'tiktok_shop_id',
        'tiktok_url',
        'status',
        'featured',
        'click_count',
    ];


    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'status' => 'boolean',
        'featured' => 'boolean',
        'click_count' => 'integer',
    ];


    /**
     * Sản phẩm thuộc một danh mục
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class
        );
    }

    public function affiliateLinks()
    {
        return $this->hasOne(AffiliateLink::class);
    }
}
