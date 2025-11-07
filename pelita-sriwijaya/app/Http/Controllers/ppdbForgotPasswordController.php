<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PpdbForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('page.ppdb.auth.forgotPassword-ppdb');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('user_ppdbs')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function broker()
    {
        return Password::broker('user_ppdbs');
    }
}
