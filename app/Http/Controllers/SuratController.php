<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use App\Models\Rekap;
use App\Models\Main;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;




class SuratController extends Controller
{
    public function index()
    {
        $jenisSurat = JenisSurat::all();

        if (Auth::user()->kasta === 'admin' || Auth::user()->kasta === 'camat') {
            $surats = Surat::with('jenisSurat')->orderBy('created_at', 'desc')->get();
        } else {
            $surats = Surat::with('jenisSurat')
                        ->where('id_user', Auth::user()->nik)
                        ->orderBy('created_at', 'desc')
                        ->get();
        }

        return view('surat.index', compact('surats', 'jenisSurat'));
    }

    


    public function create()
    {
        $jenissurats = JenisSurat::all(); // Ambil semua data dari tabel jenis_surat
        return view('surat.create', compact('jenissurats')); // Ganti 'nama_view' dengan nama view Anda
    }

    public function show(Surat $surat)
    {
        return view('surat.show', compact('surat'));
    }



    public function getSurat($id)
    {
        $jenisSurat = JenisSurat::find($id);

        if ($jenisSurat) {
            return response()->json([
                'kodesurat' => $jenisSurat->kodesurat,
                'message' => 'Data ditemukan'
            ]);
        } else {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }




   
    
    
    public function buat()
    {
        $users = User::all(); // Mengambil semua data karyawan
        return view('surat.create', compact('users')); // Kirim variabel $users ke view
    }
    




    public function store(Request $request)
    {
        // Pesan validasi
        $messages = [
            'id_user.required' => 'NIK wajib diisi!',
            'nomor_surat2.required' => 'Nomor Surat wajib diisi!',
            'nama_file.required' => 'Nama File wajib diisi!',
            'jenissurat.required' => 'Jenis Surat wajib diisi!',
            'kepada.required' => 'Kepada wajib diisi!',
            'file.required' => 'File wajib diisi!',
            'file.mimes' => 'File harus berupa dokumen dengan format: pdf, doc, atau docx.',
            'file.max' => 'Ukuran file maksimal adalah 2MB.',
            'keterangan.required' => 'Keterangan wajib diisi!',
        ];
    
        // Validasi data
        $validatedData = $request->validate([
            'id_user' => 'required',
            'nomor_surat2' => 'required',
            'nama_file' => 'required',
            'jenissurat' => 'required',
            'kepada' => 'required',
            'file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'keterangan' => 'required',
        ], $messages);
    
        // Cek apakah id_user ada di kolom nik pada tabel users
        $user = User::where('nik', $validatedData['id_user'])->first();
        if (!$user) {
            return redirect()->back()->with('error', 'NIK tidak ditemukan, Harap registrasi terlebih dahulu!');
        }
    
        // Ambil data jenis surat
        $jenissurat = JenisSurat::find($validatedData['jenissurat']);
        if (!$jenissurat) {
            return redirect()->back()->with('error', 'Jenis surat tidak valid!');
        }
    
        // Default values
        $defaultStatus = "Pending";
        $tanggalSekarang = now();
    
        // Simpan file dan hanya menyimpan nama file ke database
        $fileName = $validatedData['id_user'] . '_file.' . $request->file('file')->extension();
        $filePath = $request->file('file')->storeAs('files', $fileName, 'public');
    
        // Data yang akan disimpan
        $data = [
            'id_user' => $validatedData['id_user'],
            'nomor_surat2' => $validatedData['nomor_surat2'],
            'nama_file' => $validatedData['nama_file'],
            'jenissurat' => $jenissurat->jenissurat,
            'id_jenissurat' => $jenissurat->id_jenissurat, // Ambil dari jenis surat
            'kepada' => $validatedData['kepada'],
            'file' => $fileName, // Simpan hanya nama file
            'keterangan' => $validatedData['keterangan'],
            'status' => $defaultStatus,
            'created_at' => $tanggalSekarang,
        ];
    
        // Simpan data ke dalam database
        Main::Simpan('permintaan', $data);
    
        // Menampilkan pesan sukses
        Session::flash('success', 'Surat berhasil ditambahkan!');
        return redirect()->route('surat.index');
    }
    

    

    
    




    public function delete($nomor_surat)
    {
        $surat = Surat::find($nomor_surat);

        if (!$surat) {
            return redirect()->route('surat.index')->with('error', 'Surat tidak ditemukan');
        }
        $surat->delete();

        return redirect()->route('surat.index')->with('success', 'Surat Berhasil Dihapus');
    }


    




    public function edit($nomor_surat)
    {
        // Ambil data surat berdasarkan nomor_surat2
        $surat = Surat::where('nomor_surat', $nomor_surat)->first();
        
        // Ambil semua jenis surat
        $jenissurats = JenisSurat::all();  // Mendapatkan semua jenis surat
        
        // Jika surat tidak ditemukan, tampilkan error
        if (!$surat) {
            return redirect()->route('surat.index')->with('error', 'Surat tidak ditemukan!');
        }

        // Kembalikan view dengan data surat dan jenis surat
        return view('surat.edit', compact('surat', 'jenissurats'));
    }

    // Fungsi untuk memperbarui data surat
    public function update(Request $request, $nomor_surat)
{
    $validated = $request->validate([
        'jenissurat' => 'required|exists:jenis_surat,id_jenissurat',
        'nomor_surat2' => 'required|string|max:255',
        'kepada' => 'required|string|max:255',
        'nama_file' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:255',
        'file' => 'nullable|file|mimes:pdf,jpg,png',
    ]);

    $surat = Surat::where('nomor_surat', $nomor_surat)->firstOrFail();
    $surat->id_jenissurat = $request->jenissurat;
    $surat->nomor_surat2 = $request->nomor_surat2;
    $surat->kepada = $request->kepada;
    $surat->nama_file = $request->nama_file;
    $surat->keterangan = $request->keterangan;

    // Proses upload file jika ada
    if ($request->hasFile('file')) {
        // Pastikan Anda menangani upload file dengan benar
        $path = $request->file('file')->store('files');
        $surat->file = basename($path);
    }

    $surat->save();

    return redirect()->route('surat.index')->with('success', 'Surat berhasil diperbarui!');
}








    public function detail($nomor_surat)
    {
        $surat = Surat::find($nomor_surat);

        return view('surat.detail', compact('surat'));
    }
    















    
    
    public function setuju($nomor_surat)
{
    $surat = Surat::find($nomor_surat);

    if (!$surat) {
        return redirect()->route('surat.index')->with('error', 'Surat tidak ditemukan');
    }

    // Cek apakah data sudah ada di tabel rekap
    $existingRekap = Rekap::where('nomor_surat', $nomor_surat)->first();
    if ($existingRekap) {
        return redirect()->route('surat.index')->with('error', 'Data sudah ada di rekap!');
    }

    // Pindahkan data ke tabel jenis_surat
   

    // Perbarui status di tabel surat
    $surat->status = 'Disetujui';
    $surat->save(); // Simpan perubahan status

    return redirect()->route('surat.index')->with('success', 'Surat berhasil disetujui dan disalin ke tabel Rekap!');
}























    

public function tdksetuju($nomor_surat)
{
    $surat = Surat::find($nomor_surat);

    if (!$surat) {
        return redirect()->route('surat.index')->with('error', 'Surat tidak ditemukan');
    }

    // Pindahkan data ke tabel rekap
    

    // Hapus data dari tabel surat
    $surat->status = 'Tidak Disetujui';
    Main::Ubah('permintaan', ['status' => $surat->status], ['nomor_surat' => $surat->nomor_surat]);
    return redirect()->route('surat.index')->with('success', 'Surat Tidak Disetujui dan Dipindahkan ke Rekap!');
}




    public function template($nomor_surat) {


        $surats = Surat::with('user')->where('nomor_surat', $nomor_surat)->first();

        return view('surat.template', compact('surats'));
    }
    
    public function templaterekap($id_rekap)
    {
        $rekap = Rekap::find($id_rekap); // Ambil satu rekap berdasarkan ID
    
        if (!$rekap) {
            return redirect()->route('surat.index')->with('error', 'Data rekap tidak ditemukan.');
        }
    
        return view('surat.templaterekap', compact('rekap'));
    }
    


    public function rekap() {


        $rekaps = Rekap::all(); // Mendapatkan semua data dari model Surat

        return view('surat.rekap', compact('rekaps'));
    }

}
