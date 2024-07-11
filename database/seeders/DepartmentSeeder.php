<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()->create([
            'name' => 'Faculty of Computer Systems and Technologies (FCST)',
        ]);

        Department::factory()->create([
            'name' => 'Faculty of Computer Science (FCS)',
        ]);
    }
}
