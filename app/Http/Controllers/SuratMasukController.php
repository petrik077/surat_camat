<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\Main;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon untuk manipulasi waktu

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data surat masuk
        $suratmasuks = SuratMasuk::all();
        $suratmasuks = SuratMasuk::orderBy('tanggalmasuk', 'DESC')->get();


        return view('suratmasuk.index', compact('suratmasuks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suratmasuk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $messages = [
        'nomor_surat2.required' => 'Nomor Surat wajib diisi!',
        'nama_file.required' => 'Nama File wajib diisi!',
        'kepada.required' => 'Kepada wajib diisi!',
        'keterangan.required' => 'Keterangan wajib diisi!',
        'file.required' => 'File wajib diunggah!',
        'id_user.required' => 'NIK wajib diisi!',
    ];

    $validatedData = $request->validate([
        'nomor_surat2' => 'required',
        'nama_file' => 'required',
        'kepada' => 'required',
        'keterangan' => 'required',
        'file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'id_user' => 'required|exists:users,nik', // Validasi NIK
    ], $messages);

    // Cek apakah user ada berdasarkan NIK
    $user = User::where('nik', $validatedData['id_user'])->first();
    if (!$user) {
        return redirect()->back()->with('error', 'NIK tidak ditemukan, Harap registrasi terlebih dahulu!');
    }

    // Mendapatkan waktu sekarang dalam timezone Asia/Jakarta
    $tanggal_sekarang = Carbon::now('Asia/Jakarta');

    $fileName = $user->id . '_file.' . $request->file('file')->extension();
    $filePath = $request->file('file')->storeAs('suratmasuk', $fileName, 'public');

    $data = [
        'nomor_surat2' => $validatedData['nomor_surat2'],
        'nama_file' => $validatedData['nama_file'],
        'kepada' => $validatedData['kepada'],
        'keterangan' => $validatedData['keterangan'],
        'file' => $fileName,
    ];

    // Simpan data
    Main::Simpan('suratmasuk', $data);

    // Flash message dan redirect
    Session::flash('success', 'Surat Masuk berhasil ditambahkan!');
    return redirect()->route('suratmasuk.index');
}


    /**
     * Delete a specific resource.
     */
    public function delete($id_suratmasuk)
    {
        $suratmasuk = SuratMasuk::find($id_suratmasuk);

        if (!$suratmasuk) {
            return redirect()->route('suratmasuk.index')->with('error', 'Surat tidak ditemukan');
        }

        $suratmasuk->delete();

        return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk Berhasil Dihapus');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratMasuk $suratMasuk)
    {
        return view('suratmasuk.show', compact('suratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratMasuk $id_suratmasuk)
    {
        return view('suratmasuk.edit', compact('suratmasuk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratMasuk $id_suratmasuk)
    {
        $messages = [
            'nomor_surat2.required' => 'Nomor Surat wajib diisi!',
            'nama_file.required' => 'Nama File wajib diisi!',
            'kepada.required' => 'Kepada wajib diisi!',
            'file.required' => 'File wajib diisi!',
            'keterangan.required' => 'Keterangan wajib diisi!',
        ];

        $request->validate([
            'nomor_surat2' => 'required',
            'nama_file' => 'required',
            'kepada' => 'required',
            'file' => 'required',
            'keterangan' => 'required',
        ], $messages);

        $suratMasuk->update([
            'nomor_surat2' => $request->nomor_surat2,
            'nama_file' => $request->nama_file,
            'kepada' => $request->kepada,
            'file' => $request->file,
            'tanggalmasuk' => Carbon::now('Asia/Jakarta'), // Update dengan waktu sekarang
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratMasuk $id_suratmasuk)
    {
        $id_suratmasuk->delete();

        return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk berhasil dihapus!');
    }
}
