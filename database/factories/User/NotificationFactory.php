<?php

namespace Database\Factories\User;

use App\Models\Model;
use App\Models\User\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'offers' => rand(0, 1),
            'news' => rand(0, 1),
            'browser' => rand(0, 1)
        ];
    }
}
