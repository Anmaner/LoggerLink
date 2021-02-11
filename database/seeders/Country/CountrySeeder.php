<?php

namespace Database\Seeders\Country;

use App\Models\Logger\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $filePath = base_path() . '/database/seeders/Country/Countries.json';
        $countries = json_decode(File::get($filePath));

        foreach ($countries as $country) {
            if( !Country::where('code', $country->code)->first() ) {
                Country::create([
                    'name' => $country->name,
                    'code' => strtoupper($country->code)
                ]);
            }
        }
    }
}
