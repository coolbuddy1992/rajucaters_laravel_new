<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class Original_ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'brand_id' => 1,
           'category_id' => 1,
           'subcategory_id' => 1,
           'sub_subcategory_id' => 1,
            'product_name_en' => $this->faker->name(),
            'product_name_hi' => $this->faker->name(),
            'product_slug_en' => $this->faker->slug,
            'product_slug_hi' => $this->faker->slug,
            'product_code' => $this->faker->name(),
            'product_qty' => 10,
            'product_tags_en' => $this->faker->word(),
            'product_tags_hi' => $this->faker->word(),
            'product_size_en' => 0,
            'product_size_hi' => 0,
            'product_color_en' => 'red',
            'product_color_hi' => 'red',
            'purchase_price' => rand(100,1900),
            'selling_price' => rand(100,1900),
            'discount_price' => rand(100,1900),
            'short_description_en' => $this->faker->paragraph(),
            'short_description_hi' => $this->faker->paragraph(),
            'long_description_en' => $this->faker->paragraph(),
            'long_description_hi' => $this->faker->paragraph(),
            'product_thumbnail' => 'https://source.unsplash.com/random',
        ];
    }
}
