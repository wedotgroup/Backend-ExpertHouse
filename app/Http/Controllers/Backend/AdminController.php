<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientClinicalRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.auth.admin_login');
    }

    public function systemLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = trim($request->email);

        $data = User::where('email', $email)->first();

        if (!$data) {
            return back()->with('error', 'User not found.');
        }

        if ($data->role != "super_admin") {
            return back()->with('error', 'Authentication Fails');
        }

        if (
            Auth::guard('super_admin')->attempt([
                'email' => $email,
                'password' => $request->password
            ])
        ) {

            // Session regenerate
            $request->session()->regenerate();

            // Current session ID
            $sessionId = $request->session()->getId();


            $data->login_session_id = $sessionId;
            $data->save();

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid Credentials');
    }


    public function dashboard()
    {


        return view('admin.backend.dashboard');
    }

    public function AdminLogout(Request $request)
    {
        if (Auth::guard('super_admin')->check()) {
            Auth::guard('super_admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
    }
    public function forgetIndex()
    {
        return view('admin.auth.forgetpassword');
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'password' => "required|confirmed",
            'email' => 'required|email'
        ]);
        $email =  trim($request->email);

        $check =  User::where('email', $email)->first();
        if ($check) {
            $check->update([
                "password" => Hash::make($request->password),
            ]);
            return redirect('/')->with('success', 'Reset Password successFully');
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }
}
