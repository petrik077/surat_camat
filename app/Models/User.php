<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users'; // Nama tabel yang benar
    protected $primaryKey = 'nik'; // Ubah ke kolom yang sesuai
    public $incrementing = false; // Karena 'nik' bukan integer dan tidak auto-increment
    protected $keyType = 'string'; // Jika 'nik' adalah string


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'nama_user',
        'email',
        'password',
        'alamat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    protected $guarded =['nik'];
    public static function post_by($userId)
    {
    $query=DB::table('users')
    ->select('*')
    ->where('nik', $userId)
    ->get();

    return $query;
    }


}
