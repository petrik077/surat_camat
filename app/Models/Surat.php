<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Import DB facade

class Surat extends Model
{
    use HasFactory;

    // Jika tabel di database tidak bernama 'surats', tambahkan ini
    protected $table = 'permintaan'; // Ubah sesuai nama tabel yang benar

    // Fillable attributes
    protected $fillable = [
        'nomor_surat',
        'id_user',
        'nama_file',
        'keterangan',
        '_token', // Tambahkan _token ke fillable properties jika perlu
    ];

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
}
