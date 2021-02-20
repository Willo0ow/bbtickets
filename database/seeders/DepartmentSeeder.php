<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::updateOrCreate(['label' => 'Admin','code'=>'admin', 'supervisor'=>1]);
        Department::updateOrCreate(['label' => 'Zarząd','code'=>'board', 'supervisor'=>2]);
        Department::updateOrCreate(['label' => 'IT','code'=>'it', 'supervisor'=>3]);
        Department::updateOrCreate(['label' => 'Kadry','code'=>'hr', 'supervisor'=>5]);
    }
}
