<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
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
        $image = $this->faker->image();
        $imageFile = new File($image);

        return [
            'name' => $this->faker->company,
            'category_id' => rand(1, 5),
            'description' => $this->faker->sentence,
            'date' => $this->faker->dateTime,
            'images' => Storage::disk('public')->putFile('images', $imageFile)
        ];
    }

}
