<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    protected $table = 'users'; // Ubah sesuai nama tabel yang benar


    protected $fillable = [
        'nik',
        'nama_user',
        'email',
        'password',
        'alamat',
    ];

    
}
