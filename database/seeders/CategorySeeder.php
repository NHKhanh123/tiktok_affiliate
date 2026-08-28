<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $categories = [
            'Điện tử',
            'Đồ gia dụng',
            'Thời trang',
            'Phụ kiện điện thoại',
            'Đồ dùng nhà bếp',
            'Làm đẹp',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'Danh mục ' . $name,
                'status' => true,
            ]);
        }
    }
}
