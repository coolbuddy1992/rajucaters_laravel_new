<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category::factory()->count(50)->create();

        $category_list_en = [
            'Drinks',
            'Starters',
            'Chaat',
            'Salad',
            'Main Course',
            'Sweets',
            'Waters'
        ];

        $category_list_bn = [
            'পোশাক ও ফ্যাশন আনুষাঙ্গিক',
            'স্বাস্থ্যসেবা ও স্বাস্থ্যবিধি',
            'জুতো এবং ব্যাগ',
            'বই ও স্টেশনারি',
            'কম্পিউটার ও আনুষাঙ্গিক',
            'কনজিউমার ইলেক্ট্রনিক্স',
            'সুরক্ষা সিস্টেম ও আনুষাঙ্গিক',
            'মোবাইল ও আনুষাঙ্গিক'
        ];

        $category_list_hi = [
            'पेय',
            'स्टार्टर्स',
            'चाट',
            'सलाद',
            'मेन कोर्स',
            'मिठाइयाँ',
            'वाटर्स',
        ];

        for($i =0; $i<count($category_list_en); $i++) {
            Category::create([
                'category_name_en' => $category_list_en[$i],
                'category_name_hi' => $category_list_hi[$i],
                'category_slug_en' => Str::slug($category_list_en[$i]),
                'category_slug_hi' => Str::slug($category_list_hi[$i]),
                'category_icon' => 'fa fa-shopping-bag',
            ]);
        }
    }
}
