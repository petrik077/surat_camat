<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $table = 'jenis_surat'; // Ubah sesuai nama tabel yang benar
    protected $primaryKey = 'id_jenissurat';  


    // Fillable attributes
    protected $fillable = [
        'id_jenissurat',
        'kodesurat',
        'jenissurat',
    ];}
