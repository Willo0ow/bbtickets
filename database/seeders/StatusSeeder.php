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
        Status::updateOrCreate(['label' => 'Zgłoszone','code'=>'registered', 'type'=>'ticket', 'sequence'=>1]);
        Status::updateOrCreate(['label' => 'Zweryfikowane','code'=>'verified', 'type'=>'ticket', 'sequence'=>2]);
        Status::updateOrCreate(['label' => 'W trakcie','code'=>'in_progress', 'type'=>'ticket', 'sequence'=>3]);
        Status::updateOrCreate(['label' => 'Do konsultacji','code'=>'review', 'type'=>'ticket', 'sequence'=>4]);
        Status::updateOrCreate(['label' => 'Wstrzymane','code'=>'on_hold', 'type'=>'ticket', 'sequence'=>5]);
        Status::updateOrCreate(['label' => 'Ukończone','code'=>'closed', 'type'=>'ticket', 'sequence'=>6]);
        Status::updateOrCreate(['label' => 'Zarchiwowane','code'=>'archived', 'type'=>'ticket', 'sequence'=>7]);
        Status::updateOrCreate(['label' => 'Usunięte','code'=>'deleted', 'type'=>'ticket', 'sequence'=>8]);

        Status::updateOrCreate(['label' => 'Wysłana','code'=>'sent', 'type'=>'message', 'sequence'=>1]);
        Status::updateOrCreate(['label' => 'Nie dotarła do odbiorcy','code'=>'sent_failed', 'type'=>'message', 'sequence'=>2]);
        Status::updateOrCreate(['label' => 'Przeczytana','code'=>'read', 'type'=>'message', 'sequence'=>3]);
        Status::updateOrCreate(['label' => 'Otrzymała odpowiedź','code'=>'answered', 'type'=>'message', 'sequence'=>4]);
    }
}
