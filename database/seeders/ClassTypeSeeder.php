<?php

namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassType::create([
            'name' => 'Yoga',
            'description' => 'This is yoga class.',
            'duration' => 45
        ]);

        ClassType::create([
            'name' => 'Dance',
            'description' => 'This is dance fitness class.',
            'duration' => 45
        ]);

        ClassType::create([
            'name' => 'Soft workout',
            'description' => 'This is soft workout class.',
            'duration' => 45
        ]);

        ClassType::create([
            'name' => 'Hard Workout',
            'description' => 'This is hard work out class.',
            'duration' => 45
        ]);
    }
}
