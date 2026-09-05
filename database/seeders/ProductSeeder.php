<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Lấy danh mục
        |--------------------------------------------------------------------------
        */

        $categories = Category::where('status', true)
            ->get()
            ->keyBy('name');


        /*
        |--------------------------------------------------------------------------
        | Nếu chưa có category thì tạo category test
        |--------------------------------------------------------------------------
        */

        if ($categories->isEmpty()) {

            $categoryNames = [
                'Thời trang',
                'Làm đẹp',
                'Điện tử',
                'Gia dụng',
                'Phụ kiện',
                'Đời sống',
            ];

            foreach ($categoryNames as $name) {

                $category = Category::create([
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => 'Danh mục ' . $name,
                    'status' => true,
                ]);

                $categories->put($name, $category);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | 20 sản phẩm test
        |--------------------------------------------------------------------------
        */

        $products = [

            [
                'name' => 'Áo thun nam basic cotton',
                'category' => 'Thời trang',
                'price' => 199000,
                'sale_price' => 149000,
                'featured' => true,
            ],

            [
                'name' => 'Áo sơ mi nam form rộng',
                'category' => 'Thời trang',
                'price' => 299000,
                'sale_price' => 219000,
                'featured' => true,
            ],

            [
                'name' => 'Quần short nam thể thao',
                'category' => 'Thời trang',
                'price' => 159000,
                'sale_price' => 99000,
                'featured' => false,
            ],

            [
                'name' => 'Túi đeo chéo thời trang',
                'category' => 'Phụ kiện',
                'price' => 249000,
                'sale_price' => 179000,
                'featured' => true,
            ],

            [
                'name' => 'Mũ lưỡi trai unisex',
                'category' => 'Phụ kiện',
                'price' => 129000,
                'sale_price' => 89000,
                'featured' => false,
            ],


            [
                'name' => 'Kem chống nắng SPF 50+',
                'category' => 'Làm đẹp',
                'price' => 289000,
                'sale_price' => 199000,
                'featured' => true,
            ],

            [
                'name' => 'Sữa rửa mặt dịu nhẹ',
                'category' => 'Làm đẹp',
                'price' => 159000,
                'sale_price' => 119000,
                'featured' => false,
            ],

            [
                'name' => 'Máy massage cầm tay mini',
                'category' => 'Làm đẹp',
                'price' => 399000,
                'sale_price' => 299000,
                'featured' => true,
            ],


            [
                'name' => 'Tai nghe Bluetooth không dây',
                'category' => 'Điện tử',
                'price' => 499000,
                'sale_price' => 329000,
                'featured' => true,
            ],

            [
                'name' => 'Loa Bluetooth mini',
                'category' => 'Điện tử',
                'price' => 599000,
                'sale_price' => 399000,
                'featured' => true,
            ],

            [
                'name' => 'Đèn LED RGB để bàn',
                'category' => 'Điện tử',
                'price' => 249000,
                'sale_price' => 169000,
                'featured' => false,
            ],

            [
                'name' => 'Chuột không dây công thái học',
                'category' => 'Điện tử',
                'price' => 349000,
                'sale_price' => 249000,
                'featured' => false,
            ],


            [
                'name' => 'Bình giữ nhiệt inox 500ml',
                'category' => 'Gia dụng',
                'price' => 199000,
                'sale_price' => 139000,
                'featured' => true,
            ],

            [
                'name' => 'Hộp đựng thực phẩm đa năng',
                'category' => 'Gia dụng',
                'price' => 159000,
                'sale_price' => 109000,
                'featured' => false,
            ],

            [
                'name' => 'Nồi chiên không dầu mini',
                'category' => 'Gia dụng',
                'price' => 1290000,
                'sale_price' => 899000,
                'featured' => true,
            ],

            [
                'name' => 'Máy xay mini cầm tay',
                'category' => 'Gia dụng',
                'price' => 299000,
                'sale_price' => 199000,
                'featured' => false,
            ],


            [
                'name' => 'Đèn ngủ cảm biến thông minh',
                'category' => 'Đời sống',
                'price' => 189000,
                'sale_price' => 129000,
                'featured' => true,
            ],

            [
                'name' => 'Giá đỡ điện thoại để bàn',
                'category' => 'Phụ kiện',
                'price' => 149000,
                'sale_price' => 99000,
                'featured' => false,
            ],

            [
                'name' => 'Ba lô laptop chống nước',
                'category' => 'Phụ kiện',
                'price' => 499000,
                'sale_price' => 349000,
                'featured' => true,
            ],

            [
                'name' => 'Đồng hồ điện tử thể thao',
                'category' => 'Phụ kiện',
                'price' => 699000,
                'sale_price' => 499000,
                'featured' => true,
            ],
            [
                'name' => 'Kính mát nam nữ chống tia UV',
                'category' => 'Phụ kiện',
                'price' => 189000,
                'sale_price' => 129000,
                'featured' => false,
            ],

            [
                'name' => 'Son kem lì mịn mượt lâu trôi',
                'category' => 'Làm đẹp',
                'price' => 220000,
                'sale_price' => 165000,
                'featured' => true,
            ],

            [
                'name' => 'Bàn phím cơ không dây Bluetooth',
                'category' => 'Điện tử',
                'price' => 890000,
                'sale_price' => 699000,
                'featured' => true,
            ],

            [
                'name' => 'Sạc dự phòng 10.000mAh sạc nhanh',
                'category' => 'Điện tử',
                'price' => 350000,
                'sale_price' => 249000,
                'featured' => false,
            ],

            [
                'name' => 'Thảm tập Yoga chống trượt cao cấp',
                'category' => 'Đời sống',
                'price' => 250000,
                'sale_price' => 180000,
                'featured' => false,
            ],

            [
                'name' => 'Áo khoác Hoodie unisex rộng rãi',
                'category' => 'Thời trang',
                'price' => 380000,
                'sale_price' => 289000,
                'featured' => true,
            ],

            [
                'name' => 'Ấm siêu tốc inox 1.8L tự ngắt',
                'category' => 'Gia dụng',
                'price' => 210000,
                'sale_price' => 159000,
                'featured' => false,
            ],

            [
                'name' => 'Bộ cọ trang điểm cá nhân 8 món',
                'category' => 'Làm đẹp',
                'price' => 175000,
                'sale_price' => 119000,
                'featured' => true,
            ],

            [
                'name' => 'Kính mát nam nữ chống tia UV',
                'category' => 'Phụ kiện',
                'price' => 189000,
                'sale_price' => 129000,
                'featured' => false,
            ],

            [
                'name' => 'Son kem lì mịn mượt lâu trôi',
                'category' => 'Làm đẹp',
                'price' => 220000,
                'sale_price' => 165000,
                'featured' => true,
            ],

            [
                'name' => 'Bàn phím cơ không dây Bluetooth',
                'category' => 'Điện tử',
                'price' => 890000,
                'sale_price' => 699000,
                'featured' => true,
            ],

            [
                'name' => 'Sạc dự phòng 10.000mAh sạc nhanh',
                'category' => 'Điện tử',
                'price' => 350000,
                'sale_price' => 249000,
                'featured' => false,
            ],

            [
                'name' => 'Thảm tập Yoga chống trượt cao cấp',
                'category' => 'Đời sống',
                'price' => 250000,
                'sale_price' => 180000,
                'featured' => false,
            ],

            [
                'name' => 'Áo khoác Hoodie unisex rộng rãi',
                'category' => 'Thời trang',
                'price' => 380000,
                'sale_price' => 289000,
                'featured' => true,
            ],

            [
                'name' => 'Ấm siêu tốc inox 1.8L tự ngắt',
                'category' => 'Gia dụng',
                'price' => 210000,
                'sale_price' => 159000,
                'featured' => false,
            ],

            [
                'name' => 'Bộ cọ trang điểm cá nhân 8 món',
                'category' => 'Làm đẹp',
                'price' => 175000,
                'sale_price' => 119000,
                'featured' => true,
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | Insert
        |--------------------------------------------------------------------------
        */

        foreach ($products as $item) {

            $category = $categories->get(
                $item['category']
            );

            if (!$category) {
                continue;
            }

            $product = Product::updateOrCreate(

                [
                    'slug' => Str::slug($item['name']),
                ],

                [
                    'category_id' => $category->id,

                    'name' => $item['name'],

                    'slug' => Str::slug(
                        $item['name']
                    ),

                    'description' =>
                    'Khám phá '
                        . $item['name']
                        . ' với thiết kế đẹp, tiện dụng và phù hợp cho nhu cầu sử dụng hằng ngày.',

                    'price' => $item['price'],

                    'sale_price' => $item['sale_price'],

                    /*
                    |--------------------------------------------------------------------------
                    | Dữ liệu TikTok tạm thời
                    |--------------------------------------------------------------------------
                    */

                    'tiktok_product_id' =>
                    'TEST-' . strtoupper(
                        Str::random(10)
                    ),

                    'tiktok_shop_id' =>
                    'TEST-SHOP',

                    'tiktok_url' =>
                    'https://www.tiktok.com/shop',

                    /*
                    |--------------------------------------------------------------------------
                    | Frontend
                    |--------------------------------------------------------------------------
                    */

                    'status' => true,

                    'featured' => $item['featured'],

                    'click_count' => rand(10, 500),
                ]
            );
            ProductImage::updateOrCreate(

                [
                    'product_id' => $product->id,
                    'sort_order' => 1,
                ],

                [
                    'image_url' => 'products/default-product.jpg',
                    'is_primary' => true,
                    'sort_order' => 1,
                ]
            );
        }


        $this->command->info(
            'Đã tạo/cập nhật sản phẩm test.'
        );
    }
}
