<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tlog;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $requestData = $request->all();
        $forms = $this->assignUserToForms($requestData);

        $storedTicket =  Ticket::create($forms['ticket']);
        if($storedTicket){
            Tlog::create($form['tlog']);
        }
        return $storedTicket;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return Ticket::find($ticket)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $user = Auth::user()->id;
        $requestData = $request->all();
        $forms = $this->assignUserToForms($requestData);

        $updatedTicket =  Ticket::find($ticket)->update($forms['ticket']);
        if($updatedTicket){
            Tlog::create($forms['tlog']);
        }
        return $updatedTicket;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $tlog = array('ticket' => $ticket, 'variable'=>'status', 'value'=>'deleted', 'user'=>$user );
        $deletedTicket =  Ticket::find($ticket)->delete();
        if($deletedTicket){
            Tlog::create($tlog);
        }
        return $deletedTicket;
    }
    public function assignUserToForms($requestData){
        $user = Auth::user()->id;
        $requestData['ticket']['user'] = $user;
        $requestData['tlog']['user'] = $user;
        return $requestData;
    }
    public function retrieveByStatus($status){
        return Ticket::where('status', $status)->get();
    }
}
