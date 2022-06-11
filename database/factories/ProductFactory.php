<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            'category_id' => Null,
            'subcategory_id' => Null,
            'sub_subcategory_id' => 4,
            'product_name_en' => $this->faker->name(),
            'product_name_hi' => $this->faker->name(),
            'product_slug_en' => $this->faker->slug,
            'product_slug_hi' => $this->faker->slug,
            'product_code' => $this->faker->name(),
            'product_qty' => 1,
            'product_tags_en' => $this->faker->word(),
            'product_tags_hi' => $this->faker->word(),
            'short_description_en' => $this->faker->paragraph(),
            'short_description_hi' => $this->faker->paragraph(),
            'long_description_en' => $this->faker->paragraph(),
            'long_description_hi' => $this->faker->paragraph(),
            'product_thumbnail' => 'https://source.unsplash.com/random',
        ];
    }
}
