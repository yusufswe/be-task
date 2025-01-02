<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $divisions = Division::all();

        foreach ($divisions as $division) {
            for ($i = 1; $i <= 5; $i++) {
                Employee::create([
                    'id' => Str::uuid(),
                    'image' => 'https://via.placeholder.com/150',
                    'name' => "Employee {$i} of {$division->name}",
                    'phone' => '08123456789' . $i,
                    'division_id' => $division->id,
                    'position' => 'Staff',
                ]);
            }
        }
    }
}
