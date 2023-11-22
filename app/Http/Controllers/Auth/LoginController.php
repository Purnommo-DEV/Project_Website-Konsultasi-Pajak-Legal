<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function halaman_login()
    {
        return view('Front.login_register.login');
    }

    public function autentikasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'password' => 'required|min:8',
        ], [
            'nik.required' => 'Wajib diisi',
            'password.required' => 'Wajib diisi',
            'password.min' => 'Minimal 8 karakter',
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if (Auth::attempt($request->only('nik', 'password'))) {
                if (auth()->user()->role_id == 1) {
                    return response()->json([
                        'status_berhasil_login' => 1,
                        'msg' => 'Berhasil login sebagai Admin !',
                        'route' => route('admin.HalamanDashboard')
                    ]);
                } elseif (auth()->user()->role_id == 2) {
                    return "Konsultan";
                    // return response()->json([
                    //     'status_berhasil_login' => 1,
                    //     'msg' => 'Berhasil login!',
                    //     'route' => route('HalamanBeranda')
                    // ]);
                } elseif (auth()->user()->role_id == 3) {
                    return "Client";
                    // return response()->json([
                    //     'status_berhasil_login' => 1,
                    //     'msg' => 'Berhasil login!',
                    //     'route' => route('HalamanBeranda')
                    // ]);
                }
            } else {
                return response()->json([
                    'status_user_pass_salah' => 1,
                    'msg' => 'Login gagal, NIK atau Password salah !',
                ]);
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('HalamanBeranda');
    }
}
