<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SuratController extends Controller
{
    public function index()
{
    $surats = Surat::all(); // Mendapatkan semua data dari model Surat
    return view('surat.index', compact('surats')); // Kirim variabel $surats ke view
}


    public function create()
    {
        return view('surat.create');
    }

    public function show(Surat $surat)
    {
        return view('surat.show', compact('surat'));
    }



   
    
    
    public function buat()
    {
        $users = User::all(); // Mengambil semua data karyawan
        return view('surat.create', compact('users')); // Kirim variabel $users ke view
    }
    




    public function store(Request $request)
    {
        $messages = [
            'nomor_surat.required' => 'Nomor Surat wajib diisi!',
            'id_user.required' => 'NIK wajib diisi!',
            'nama_file.required' => 'Nama File wajib diisi!',
            'keterangan.required' => 'Keterangan wajib diisi!',
        ];
    
        $request->validate([
            'nomor_surat' => 'required',
            'id_user' => 'required',
            'nama_file' => 'required',
            'keterangan' => 'required',
        ], $messages);
    
        // Mengambil data dari request form, kecuali _token
        $postData = $request->except('_token');
    
        // Simpan data model Post
        Surat::create($postData);
    
        // Redirect atau lakukan tindakan selanjutnya
        return redirect()->route('surat.index')->with('success', 'Data berhasil dibuat!');
    }




    public function destroy($id)
    {
        // Temukan post yang akan dihapus berdasarkan ID
        $surat = Surat::find($id);
    
        if (!$surat) {
            // Jika post tidak ditemukan, mungkin hendak menangani kasus ini
            return redirect()->route('surat.index')->with('error', 'Surat not found');
        }
    
        // Hapus post
        $surat->delete();
    
        // Redirect ke halaman indeks dengan pesan sukses
        return redirect()->route('surat.index')->with('success', 'Data Berhasil Dihapus');
    }




    public function edit($id)
    {
        $surat = Surat::find($id);
    
        if (!$surat) {
            return redirect()->route('surat.index')->with('error', 'Surat not found');
        }
    
        return view('surat.edit', compact('surat'));
    }



    public function update(Request $request, $id)
    {
        $messages = [
            'nomor_surat.required' => 'Nomor Surat wajib diisi!',
            'id_user.required' => 'ID User wajib diisi!',
            'nama_file.required' => 'Nama File diisi!',
            'keterangan.required' => 'Keterangan wajib diisi!',
        ];
    
        $request->validate([
            'nomor_surat' => 'required',
            'id_user' => 'required',
            'nama_file' => 'required',
            'keterangan' => 'required',
        ], $messages);
    
        $surat = Surat::find($id);
    
        if (!$surat) {
            return redirect()->route('surat.index')->with('error', 'Surat tidak ditemukan');
        }
    
        $surat->nomor_surat = $request->nomor_surat;
        $surat->id_user = $request->id_user;
        $surat->nama_file = $request->nama_file;
        $surat->keterangan = $request->keterangan;
        $surat->save();
    
        return redirect()->route('surat.index')->with('success', 'Surat Berhasil Diubah!');
    }





}
