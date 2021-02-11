<?php

namespace Database\Seeders;

use App\Models\Logger\Follow;
use App\Models\Logger\Logger;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\Country\CountrySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->has(
            Logger::factory(10)->has(
                Follow::factory(10)
            )
        )->create();

        $this->call(CountrySeeder::class);
    }
}
