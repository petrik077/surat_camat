<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    use HasFactory;



    protected $table = 'rekap'; // Ubah sesuai nama tabel yang benar
    protected $primaryKey = 'id_rekap';  


    // Fillable attributes
    protected $fillable = [
        'id_rekap',
        'id_admin',
        'id_user',
        'id_surat',
        'id_jenissurat',
        'nomor_surat',
        'nomor_surat2',
        'kepada',
        'nama_file',
        'jenissurat',
        'file',
        'keterangan',
        'created_at',
        'status',
        '_token', // Tambahkan _token ke fillable properties jika perlu
    ];


// Di model Surat
// Model Surat
public function jenisSurat()
{
    return $this->belongsTo(JenisSurat::class, 'id_jenissurat', 'id_jenissurat');
}





}
