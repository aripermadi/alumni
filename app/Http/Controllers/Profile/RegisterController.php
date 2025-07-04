<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('modules.profile.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'angkatan' => 'required|string|max:10',
            'pekerjaan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:30',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'alumni',
            ]);

            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('alumni', 'public');
            }

            $user->alumni()->create([
                'angkatan' => $request->angkatan,
                'jurusan' => 'Kedokteran',
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'foto' => $fotoPath,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['register' => 'Registrasi gagal: ' . $e->getMessage()])->withInput();
        }

        // Redirect ke login setelah registrasi
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
} 