<?php

namespace Database\Factories\User;

use App\Models\User\EmailChange;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmailChangeFactory extends Factory
{
    protected $model = EmailChange::class;

    public function definition()
    {
        return [
            'status' => EmailChange::OLD_REQUESTED,
            'email' => $this->faker->unique()->safeEmail,
            'old_token' => null,
            'new_token' => null,
        ];
    }
}
