<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::updateOrCreate(['label' => 'Zgłoszone','code'=>'registered', 'type'=>'ticket']);
        Status::updateOrCreate(['label' => 'Zweryfikowane','code'=>'verified', 'type'=>'ticket']);
        Status::updateOrCreate(['label' => 'W trakcie','code'=>'in_progress', 'type'=>'ticket']);
        Status::updateOrCreate(['label' => 'Do konsultacji','code'=>'review', 'type'=>'ticket']);
        Status::updateOrCreate(['label' => 'Wstrzymane','code'=>'on_hold', 'type'=>'ticket']);
        Status::updateOrCreate(['label' => 'Ukończone','code'=>'closed', 'type'=>'ticket']);
        Status::updateOrCreate(['label' => 'Usunięte','code'=>'deleted', 'type'=>'ticket']);
        Status::updateOrCreate(['label' => 'Zarchiwowane','code'=>'archived', 'type'=>'ticket']);

        Status::updateOrCreate(['label' => 'Wysłana','code'=>'sent', 'type'=>'message']);
        Status::updateOrCreate(['label' => 'Nie dotarła do odbiorcy','code'=>'sent_failed', 'type'=>'message']);
        Status::updateOrCreate(['label' => 'Przeczytana','code'=>'read', 'type'=>'message']);
        Status::updateOrCreate(['label' => 'Otrzymała odpowiedź','code'=>'answered', 'type'=>'message']);
    }
}
