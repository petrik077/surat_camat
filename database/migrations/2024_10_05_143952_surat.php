<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('temp_surat', function (Blueprint $table) {
            $table->id('id_surat');
            $table->string('nama_surat');
        });



        Schema::create('permintaan', function (Blueprint $table) {
            $table->id('nomor_surat');
            $table->unsignedBigInteger('id_user'); // Tipe data harus sesuai dengan tipe 'nik' di tabel 'user'
            $table->foreign('id_user')->references('nik')->on('users'); // Menghubungkan ke tabel 'user'
            $table->string('nama_file');
            $table->string('keterangan');
            $table->timestamps();
        });



        Schema::create('rekap', function (Blueprint $table) {
            $table->id('id_rekap'); // Primary key

            // Foreign key untuk id_admin, perlu sesuaikan dengan tabel 'admin' jika ada
            $table->unsignedBigInteger('id_admin')->nullable(); // Jika admin opsional, tambahkan nullable
            $table->foreign('id_admin')->references('id_admin')->on('admin');
            // $table->foreign('id_admin')->references('id')->on('admin'); // Jika ada tabel admin
            
            $table->unsignedBigInteger('id_user'); // Relasi ke tabel 'user' (kolom 'nik')
            $table->foreign('id_user')->references('nik')->on('users');
            
            $table->unsignedBigInteger('id_surat'); // Relasi ke 'permintaan' melalui 'nomor_surat'
            $table->foreign('id_surat')->references('nomor_surat')->on('permintaan');
            
            $table->string('nama_file');
            $table->string('keterangan');
            $table->string('status'); // Status (misalnya: pending, approved, rejected)
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
