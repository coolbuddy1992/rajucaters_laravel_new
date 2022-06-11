<?php

namespace Database\Factories;

use App\Models\SubSubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubSubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubSubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    //     $category_id = 1;
    //     $subcategory_id = 1;
    //     $subsubcategory_name_en = $this->faker->name();
    //     $subsubcategory_name_hi = $this->faker->name();
    // return [
    //     'category_id' => $category_id,
    //     'subcategory_id' => $subcategory_id,
    //     'subsubcategory_name_en' => $subsubcategory_name_en,
    //     'subsubcategory_name_hi' => $subsubcategory_name_hi,
    //     'subsubcategory_slug_en' => Str::slug($subsubcategory_name_en),
    //     'subsubcategory_slug_hi' => Str::slug($subsubcategory_name_hi),
    //     ];
        for($i=1; $i<=2; $i++){
            $category_id[] = 7;
            $subcategory_id[] = 7;
            $subsubcategory_name_en[] = $this->faker->name();
            $subsubcategory_name_hi[] = $this->faker->name();
        }
        return [
            'category_id' => $category_id[0],
            'subcategory_id' => $subcategory_id[0],
            'subsubcategory_name_en' => $subsubcategory_name_en[0],
            'subsubcategory_name_hi' => $subsubcategory_name_hi[0],
            'subsubcategory_slug_en' => Str::slug($subsubcategory_name_en[0]),
            'subsubcategory_slug_hi' => Str::slug($subsubcategory_name_hi[0]),
            ];
    }
}
