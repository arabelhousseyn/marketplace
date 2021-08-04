<?php

namespace Database\Factories;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Listing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'title' => $this->faker->title(),
            'price' => $this->faker->randomNumber(2),
            'description' => $this->faker->text(300),
            'location' => '0,0',
            'category_id' => 1,
            'available' => 0,
        ];
    }
}
