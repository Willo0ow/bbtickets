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
        Category::updateOrCreate(['label' => 'Potrzebny kontakt z klientem','code'=>'cli_contact', 'default_assignee'=>6,'department'=>'sales']);
        Category::updateOrCreate(['label' => 'Braki w zamówieniu','code'=>'order_incomplete', 'default_assignee'=>7,'department'=>'sales']);
        Category::updateOrCreate(['label' => 'Błędy technologiczne w zamówieniu','code'=>'order_tech', 'default_assignee'=>8,'department'=>'sales']);
    }
}
