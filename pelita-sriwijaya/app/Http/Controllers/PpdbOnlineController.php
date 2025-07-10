<?php

namespace App\Http\Controllers;

use App\Models\ppdbOnline;
use Illuminate\Http\Request;

class PpdbOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.ppdb.ppdb-online');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ppdbOnline $ppdbOnline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ppdbOnline $ppdbOnline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ppdbOnline $ppdbOnline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ppdbOnline $ppdbOnline)
    {
        //
    }
}
