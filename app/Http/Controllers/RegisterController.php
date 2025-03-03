<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan Anda menggunakan model User yang benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('register.index');
    }
    public function index2()
    {
        return view('registrasi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register.index');
    }
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'nik.required' => 'NIK wajib diisi!',
            'nama_user.required' => 'Nama User wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
        ];
    
        $request->validate([
            'nik' => 'required|unique:users',
            'nama_user' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'alamat' => 'required',
        ], $messages);
    
        // Definisikan variabel $data
        $data = [
            'nik' => $request->nik,
            'nama_user' => $request->nama_user, // Pastikan ini ada
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'alamat' => $request->alamat,
        ];
    
        // Gunakan model User untuk menyimpan data
        User::create($data); // Simpan data dengan Eloquent
    
        // Flash message dan redirect
        session()->flash('success', 'User berhasil ditambahkan!');
        return redirect()->route('surat.index'); // Ganti dengan route yang sesuai
    }



    
    public function store2(Request $request)
    {
        $messages = [
            'nik.required' => 'NIK wajib diisi!',
            'nama_user.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
        ];
    
        $request->validate([
            'nik' => 'required|unique:users',
            'nama_user' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'alamat' => 'required',
        ], $messages);
    
        // Definisikan variabel $data
        $data = [
            'nik' => $request->nik,
            'nama_user' => $request->nama_user, // Pastikan ini ada
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'alamat' => $request->alamat,
        ];
    
        // Gunakan model User untuk menyimpan data
        User::create($data); // Simpan data dengan Eloquent
    
        // Flash message dan redirect
        session()->flash('success', 'Registrasi berhasil, silahkan login!');
        return redirect('/'); // Ganti dengan route yang sesuai
    }

    // Metode lainnya tetap seperti yang ada
}
