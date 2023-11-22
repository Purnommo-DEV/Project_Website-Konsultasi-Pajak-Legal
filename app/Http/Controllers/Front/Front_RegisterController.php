<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Front_RegisterController extends Controller
{
    public function halaman_register()
    {
        return view('Front.login_register.register');
    }

    public function proses_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'nik' => 'required',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Wajib diisi',
            'email.required' => 'Wajib diisi',
            'email.email' => 'Harus berupa email @',
            'email.unique' => 'Email yang anda masukkan telah terdaftar',
            'nik.required' => 'Wajib diisi',
            'email.unique' => 'Email yang anda masukkan telah terdaftar',
            'password.required' => 'Wajib diisi',
            'password.min' => 'Minimal 8 karakter',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            User::create([
                'kode' => 'CL-' . $this->generateUniqueNumber(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nik' => $request->nik,
                'role_id' => 3
            ]);

            return response()->json([
                'status_berhasil_register' => 1,
                'msg' => 'Berhasil Melakukan Registrasi',
                'route' => route('HalamanLogin')
            ]);
        }
    }

    public function generateUniqueNumber()
    {
        do {
            $kode = random_int(100000, 999999);
        } while (User::where("kode", "=", $kode)->first());

        return $kode;
    }
}
