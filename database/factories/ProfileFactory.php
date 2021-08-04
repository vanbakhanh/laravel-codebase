<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName('male' | 'female'),
            'last_name' => $this->faker->lastname,
            'avatar' => config('constants.avatar_default'),
            'address' => $this->faker->address,
            'phone' => $this->faker->tollFreePhoneNumber,
            'birthday' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'gender' => rand(0, 1),
        ];
    }
}
