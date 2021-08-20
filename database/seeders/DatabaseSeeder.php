<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Professional;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory()
        //                 ->count(10)
        //                 ->for(Patient::factory())
        //                 ->create();
        
        Patient::factory()->count(50)->has(\App\Models\User::factory()->count(1))->create();
        Professional::factory()->count(15)->has(\App\Models\User::factory()->count(1))->create();
    }
}
