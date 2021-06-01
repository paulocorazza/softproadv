<?php

namespace Database\Seeders;


use App\Models\Country;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    public function __construct(
        private Country $country
    )
    {
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->country->create([
           'id'     => 1058,
           'name'   => 'Brasil'
        ]);
    }
}
