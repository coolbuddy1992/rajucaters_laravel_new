<?php

namespace Database\Factories;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        for($i=1; $i<=7; $i++){
            $category_id[] = $i;
            $subcategory_name_en[] = $this->faker->name();
            $subcategory_name_hi[] = $this->faker->name();
        }
        return [
            'category_id' => $category_id[0],
            'subcategory_name_en' => $subcategory_name_en[0],
            'subcategory_name_hi' => $subcategory_name_hi[0],
            'subcategory_slug_en' => Str::slug($subcategory_name_en[0]),
            'subcategory_slug_hi' => Str::slug($subcategory_name_hi[0]),
            ];
    }
}
