<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Division::create([
            'id' => Str::uuid(),
            'name' => 'Technology',
        ]);
        Division::create([
            'id' => Str::uuid(),
            'name' => 'Law',
        ]);
        Division::create([
            'id' => Str::uuid(),
            'name' => 'Finance',
        ]);
    }
}
