<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page.
     */
    public function index()
    {
        return view('page.about'); // Pastikan view-nya ada di resources/views/page/about.blade.php
    }

    /**
     * Show the form for creating a new resource (Not used).
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource (Not used).
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource (Not used).
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource (Not used).
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource (Not used).
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource (Not used).
     */
    public function destroy($id)
    {
        //
    }
}
