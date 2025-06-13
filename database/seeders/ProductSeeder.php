<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'ทีสุดของสมาร์ทโฟน Apple รุ่นใหม่ล่าสุด',
                'price' => 37900.00,
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'description' => 'สมาร์ทโฟนเรือธงจาก Samsung พร้อมจอ AMOLED',
                'price' => 29900.00,
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'description' => 'หูฟังตัดเสียงรบกวนระดับพรีเมียม',
                'price' => 12900.00,
            ],
            [
                'name' => 'MacBook Air M3',
                'description' => 'แล็ปท็อปบางเบาจาก Apple ใช้ชิป M3 ใหม่ล่าสุด',
                'price' => 41900.00,
            ],
            [
                'name' => 'iPad Pro 13" M4',
                'description' => 'แท็บเล็ตทรงพลังพร้อมหน้าจอ OLED และชิป M4',
                'price' => 45900.00,
            ],
            [
                'name' => 'Dell XPS 15',
                'description' => 'โน้ตบุ๊กพรีเมียมจาก Dell พร้อมจอ 4K และ Intel Core i9',
                'price' => 58900.00,
            ],
            [
                'name' => 'GoPro Hero 12',
                'description' => 'กล้องแอคชันกันน้ำระดับโปร ถ่ายวิดีโอ 5.3K',
                'price' => 15900.00,
            ],
            [
                'name' => 'Logitech MX Master 3S',
                'description' => 'เมาส์ไร้สายระดับโปรสำหรับงาน productivity',
                'price' => 3290.00,
            ],
            [
                'name' => 'PlayStation 5',
                'description' => 'เครื่องเล่นเกมคอนโซลยุคใหม่จาก Sony',
                'price' => 16900.00,
            ],
        ];


        foreach ($products as $p) {
            Product::firstOrCreate(['name' => $p['name']], $p);
        }
    }
}
