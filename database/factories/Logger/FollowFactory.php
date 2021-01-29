<?php

namespace Database\Factories\Logger;

use App\Models\Logger\Follow;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowFactory extends Factory
{
    protected $model = Follow::class;

    public function definition()
    {
        return [
            'ip' => $this->faker->ipv4,
            'provider' => $this->faker->word,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'os' => $this->faker->randomElement(['Windows', 'Linux', 'Android', 'IOS']),
            'browser' => $this->faker->randomElement(['Chrome', 'Firefox', 'Opera', 'Safari']),
            'from' => $this->faker->domainName,
            'created_at' => $this->faker->dateTimeBetween('-2 months', 'now')
        ];
    }
}
