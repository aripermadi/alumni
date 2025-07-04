<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('modules.profile.index');
    }

    public function edit()
    {
        $user = Auth::user();
        $alumni = $user->alumni;
        return view('modules.profile.edit', compact('user', 'alumni'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $alumni = $user->alumni;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'angkatan' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            // 'foto' => 'nullable|image|max:2048', // jika ingin upload foto
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        if ($alumni) {
            $alumni->angkatan = $request->angkatan;
            $alumni->jurusan = $request->jurusan;
            $alumni->pekerjaan = $request->pekerjaan;
            $alumni->alamat = $request->alamat;
            $alumni->no_hp = $request->no_hp;
            // $alumni->foto = ... // handle upload jika ada
            $alumni->save();
        }
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diupdate.');
    }

    public function password()
    {
        return view('modules.profile.password');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('profile.index')->with('success', 'Password berhasil diubah.');
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:5120', // izinkan upload sampai 5MB, nanti dikompres jika >2MB
        ]);
        $user = Auth::user();
        $alumni = $user->alumni;
        if ($alumni) {
            if ($alumni->foto) {
                \Storage::disk('public')->delete($alumni->foto);
            }
            $file = $request->file('foto');
            if ($file->getSize() > 2048 * 1024) {
                $img = Image::make($file)->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('jpg', 80); // kompres kualitas 80%
                $filename = 'alumni/' . uniqid() . '.jpg';
                \Storage::disk('public')->put($filename, $img);
                $alumni->foto = $filename;
            } else {
                $path = $file->store('alumni', 'public');
                $alumni->foto = $path;
            }
            $alumni->save();
        }
        return redirect()->route('profile.index')->with('success', 'Foto profil berhasil diupdate.');
    }
} 