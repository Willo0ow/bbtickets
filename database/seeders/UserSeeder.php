<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(['name' => 'Admin','email'=>'admin@test.com', 'notification_email'=>'test.bbtickets@gmail.com', 'password' => Hash::make('admin@123'),'department'=>'admin', 'position'=>'admin']);
        User::updateOrCreate(['name' => 'John Doe','email'=>'john.doe@test.com', 'notification_email'=>'test.bbtickets@gmail.com','password' => Hash::make('test@123'), 'department'=>'board', 'position'=>'ceo']);
        User::updateOrCreate(['name' => 'Beth Smith','email'=>'beth.smith@test.com', 'notification_email'=>'test.bbtickets@gmail.com', 'password' => Hash::make('test@123'),'department'=>'it', 'position'=>'supervisors']);
        User::updateOrCreate(['name' => 'John Smith','email'=>'john.smith@test.com', 'notification_email'=>'test.bbtickets@gmail.com', 'password' => Hash::make('test@123'), 'department'=>'it', 'position'=>'test']);
        User::updateOrCreate(['name' => 'Joe Doe','email'=>'joe.doe@test.com', 'notification_email'=>'test.bbtickets@gmail.com', 'password' => Hash::make('test@123'),'department'=>'hr', 'position'=>'test']);
    }
}
