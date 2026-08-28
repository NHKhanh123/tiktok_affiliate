<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::first();

        Product::create([
            'category_id' => $category->id,
            'name' => 'Máy xay sinh tố mini',
            'slug' => Str::slug('Máy xay sinh tố mini'),
            'description' => 'Máy xay sinh tố mini tiện lợi.',
            'price' => 350000,
            'sale_price' => 249000,
            'tiktok_product_id' => 'TEST001',
            'tiktok_shop_id' => 'SHOP001',
            'tiktok_url' => 'https://www.tiktok.com/',
            'status' => true,
            'featured' => true,
            'click_count' => 0,
        ]);

        Product::create([
            'category_id' => $category->id,
            'name' => 'Đèn ngủ cảm ứng',
            'slug' => Str::slug('Đèn ngủ cảm ứng'),
            'description' => 'Đèn ngủ cảm ứng tiện dụng.',
            'price' => 250000,
            'sale_price' => 179000,
            'tiktok_product_id' => 'TEST002',
            'tiktok_shop_id' => 'SHOP001',
            'tiktok_url' => 'https://www.tiktok.com/',
            'status' => true,
            'featured' => false,
            'click_count' => 0,
        ]);
    }
}
