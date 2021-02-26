<?php

namespace App\Http\Controllers;

use App\Models\Tlog;
use Illuminate\Http\Request;

class TlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tlog  $tlog
     * @return \Illuminate\Http\Response
     */
    public function show(Tlog $tlog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tlog  $tlog
     * @return \Illuminate\Http\Response
     */
    public function edit(Tlog $tlog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tlog  $tlog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tlog $tlog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tlog  $tlog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tlog $tlog)
    {
        //
    }

    public function retrieveTicketLogs($ticket)
    {
        return Tlog::where('ticket', $ticket)->get();
    }
}
