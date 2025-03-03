<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Main extends Model
{
public static function Simpan($table, $data){
    return DB::table($table)->insert($data);;
}

public static function Ubah($table, $data, $where){
    return DB::table($table)->where($where)->update($data);;

}

public static function Hapus($table, $where){
    return DB::table($table)->where($where)->delete();

}

public static function AmbilById($table, $id)
    {
        // Lakukan query untuk mengambil data dari tabel berdasarkan ID
        $data = DB::table($table)->where('nomor_surat', $id)->first(); // Sesuaikan sesuai dengan struktur database dan model yang digunakan

        return $data; // Kembalikan data yang telah diambil dari tabel
    }

}