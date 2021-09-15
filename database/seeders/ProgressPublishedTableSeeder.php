<?php

namespace Database\Seeders;

use App\Models\ProcessProgress;
use Illuminate\Database\Seeder;

class ProgressPublishedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $progresses = ProcessProgress::get();

        foreach ($progresses as $progress) {
            if (empty($progress->published_at)) {
                $progress->published_at = now();
                $progress->save();
            }
        }
    }
}
