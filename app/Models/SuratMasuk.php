<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'suratmasuk'; // Ubah sesuai nama tabel yang benar
    protected $primaryKey = 'id_suratmasuk';  


    // Fillable attributes
    protected $fillable = [
        'nomor_surat2',
        'nama_file',
        'kepada',
        'tanggalmasuk',
        'keterangan',
        'file',
        '_token', // Tambahkan _token ke fillable properties jika perlu
    ];
}
