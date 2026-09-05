<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Hình ảnh sản phẩm
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function affiliateLinks()
    {
        return $this->hasOne(AffiliateLink::class);
    }

    public function affiliateClicks()
    {
        return $this->hasMany(
            AffiliateClick::class
        );
    }

    public function affiliateOrders()
    {
        return $this->hasMany(
            AffiliateOrder::class
        );
    }
}
