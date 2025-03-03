@extends('layout')

@section('content')

<style>
    .custom-left {
        margin-left: -50px; /* Penyesuaian jarak margin kiri */
    }

    .welcome-message {
        border-bottom: 3px solid #4CAF50; /* Menambahkan garis bawah dengan warna hijau yang lebih lembut */
        padding-bottom: 15px; /* Memberikan jarak lebih luas antara teks dan garis */
        font-size: 2rem; /* Ukuran font lebih besar untuk memberikan kesan lebih menyambut */
        color: #333; /* Warna font lebih gelap untuk kontras yang lebih baik */
        text-align: center; /* Menengahkan teks */
        margin-top: 30px; /* Memberikan jarak atas yang lebih luas */
    }

    .welcome-message span {
        font-weight: bold; /* Menebalkan nama pengguna untuk penekanan */
        color: #007BFF; /* Warna biru untuk nama pengguna */
    }
</style>

<div class="container">
    <h1 class="welcome-message">
        Selamat Datang, 
        @if (auth()->user()->kasta === 'admin')
            <span>Admin</span>
        @else
            <span>{{ auth()->user()->nama_user }}</span>
        @endif
    </h1>
</div>

@endsection
