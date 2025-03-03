<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Main;
use App\Models\Session;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil parameter pencarian jika ada
        $search = $request->get('search');
        
        // Jika ada pencarian, filter data berdasarkan 'jenissurat'
        if ($search) {
            $jenissurats = JenisSurat::where('jenissurat', 'like', "%{$search}%")->get();
            
            // Cek apakah ada data yang ditemukan
            if ($jenissurats->isEmpty()) {
                // Kirim pesan jika tidak ada data
                return view('jenissurat.index', compact('jenissurats'))->with('error', 'Surat tidak ada');
            }
        } else {
            // Jika tidak ada pencarian, ambil semua data
            $jenissurats = JenisSurat::all();
        }

        return view('jenissurat.index', compact('jenissurats'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('jenissurat.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Pesan validasi
    $messages = [
        'kodesurat.required' => 'Kode Surat wajib diisi!',
    ];

    // Validasi data
    $validatedData = $request->validate([
        'jenissurat' => 'required',
        'kodesurat' => 'required',
    ], $messages);

    // Data yang akan disimpan
    $data = [
        'jenissurat' => $validatedData['jenissurat'], // Notasi array
        'kodesurat' => $validatedData['kodesurat'],  // Notasi array
    ];

    // Simpan data ke dalam database
    Main::Simpan('jenis_surat', $data);

    // Menampilkan pesan sukses
    Session::flash('success', 'Surat berhasil ditambahkan!');
    return redirect()->route('jenissurat.index');
}


    /**
     * Display the specified resource.
     */
    public function show(JenisSurat $jenisSurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisSurat $jenisSurat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisSurat $jenisSurat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisSurat $jenisSurat)
    {
        //
    }
}
