<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB; // Import DB facade
use Illuminate\Http\Request;


class Surat extends Model
{
    use HasFactory;

    // Jika tabel di database tidak bernama 'surats', tambahkan ini
    protected $table = 'permintaan'; // Ubah sesuai nama tabel yang benar
    protected $primaryKey = 'nomor_surat';  


    // Fillable attributes
    protected $fillable = [
        'nomor_surat',
        'id_user',
        'nomor_surat2',
        'nama_file',
        'jenissurat',
        'id_jenissurat',
        'file',
        'kepada',
        'keterangan',
        '_token', // Tambahkan _token ke fillable properties jika perlu
    ];



    public static function Hapus($table, $where){
        return DB::table($table)->where($where)->delete();
    
    }



    // Menggunakan query builder (opsi 1)
    public static function post_by($userId)
    {
        $query = DB::table('permintaan') // Pastikan tabel ini ada
            ->select('*')
            ->where('id_user', $userId)
            ->get();

        return $query;
    }

    // Menggunakan Eloquent (opsi 2, direkomendasikan)
    public static function post_by_user($userId)
    {
        return self::where('id_user', $userId)->get();
    }



    public static function AmbilById($table, $nomor_surat)
    {
        // Lakukan query untuk mengambil data dari tabel berdasarkan ID
        $surat = DB::table($table)->where('nomor_surat', $nomor_surat)->first(); // Sesuaikan sesuai dengan struktur database dan model yang digunakan

        return $surat; // Kembalikan data yang telah diambil dari tabel
    }




    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'nik');
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenissurat', 'id_jenissurat');
    }


}
