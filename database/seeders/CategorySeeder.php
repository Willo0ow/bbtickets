<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate(['label' => 'Problem z winpro 10','code'=>'winX', 'default_assignee'=>2,'department'=>'it']);
        Category::updateOrCreate(['label' => 'Potrzeba zmiany technologicznej','code'=>'tech_changes', 'default_assignee'=>2,'department'=>'it']);
        Category::updateOrCreate(['label' => 'Problem BBSoftware','code'=>'bbsoftware', 'default_assignee'=>3,'department'=>'it']);
    }
}
