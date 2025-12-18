<?php

namespace App\Http\Controllers;

use App\Models\registerAccountPPDB;
use App\Models\UserPpdb;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterAccountPPDBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.ppdb.auth.registerAccount');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user_ppdbs'],
            'nomor_handphone' => ['required', 'string', 'min:11', 'max:13', 'unique:user_ppdbs'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = UserPpdb::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => strtolower($request->email),
            'nomor_handphone' => $request->nomor_handphone,
            'password' => Hash::make($request->password),
        ]);

        // Login-kan user secara otomatis
        Auth::guard('ppdb')->login($user);

        // Arahkan ke halaman pengisian data orang tua
        return redirect()->route('ppdb.data-orangtua.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(registerAccountPPDB $registerAccountPPDB)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(registerAccountPPDB $registerAccountPPDB)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, registerAccountPPDB $registerAccountPPDB)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(registerAccountPPDB $registerAccountPPDB)
    {
        //
    }
}
