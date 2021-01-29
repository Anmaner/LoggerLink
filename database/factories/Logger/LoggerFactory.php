<?php

namespace Database\Factories\Logger;

use App\Models\Logger\Logger;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LoggerFactory extends Factory
{
    protected $model = Logger::class;

    public function definition()
    {
        return [
            'token' => Str::random(15),
            'code' => $this->faker->randomNumber(6),
            'redirect' => $this->faker->url,
            'type' => $this->faker->randomElement(Logger::getTypeList()),
            'status' => $this->faker->randomElement(Logger::getStatusList())
        ];
    }
}
