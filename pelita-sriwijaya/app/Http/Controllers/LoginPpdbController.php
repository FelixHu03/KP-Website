<?php

namespace App\Http\Controllers;

use App\Models\loginPpdb;
use App\Models\User;
use App\Models\UserPpdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginPpdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function showLoginForm()
    {
        return view('page.ppdb.auth.login-ppdb');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);
        $inputLogin = $request->login;
        $inputLoginLowercase = strtolower($inputLogin);
        // Cek berdasarkan email atau nomor handphone
        $user = UserPpdb::where('email', $inputLoginLowercase)
            ->orWhere('nomor_handphone', $inputLogin)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('ppdb')->login($user);
            // dd('Login berhasil'); // <-- debug
            return redirect()->route('ppdb-online.index');
        }

        return back()->with('error', 'Login gagal. Periksa kembali data Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
    public function index()
    {
        //
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
    public function show(loginPpdb $loginPpdb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(loginPpdb $loginPpdb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, loginPpdb $loginPpdb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(loginPpdb $loginPpdb)
    {
        //
    }
}
