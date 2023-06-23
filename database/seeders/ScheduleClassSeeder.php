<?php

namespace Database\Seeders;

use App\Models\ScheduleClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScheduleClass::factory()->count(10)->create();
    }
}
