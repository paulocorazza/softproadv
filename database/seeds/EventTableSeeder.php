<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'title' => 'Reunião',
                'start' => '2019-10-11 21:30:00',
                'end' => '2019-10-12 21:30:00',
                'color' => '#c40233',
                'description' => 'Reunião com cliente'
            ],

            [
                'title' => 'Ligar p/cliente',
                'start' => '2019-10-02',
                'end' => '2019-10-02',
                'color' => '#c40253',
                'description' => 'Falar com cliente'
            ],
        ]);
    }
}
