<style>
    .custom-navbar {
        background-color: #007bff; /* Warna biru */
    }

    .custom-logo-button {
        margin-left: 30px; /* Margin 30 piksel di sebelah kiri */
        margin-top: 10px; /* Margin 10 piksel di atas */
    }

    .custom-judul-button {
        margin-left: 10px; /* Margin 60 piksel di sebelah kiri */
    }

    .custom-logout-button {
        margin-left: auto; /* Menggunakan auto margin untuk mendorong tombol logout ke kanan */
    }

    .custom-address {
        font-size: 12px; /* Menambahkan ukuran font kecil untuk alamat */
        color: #ffffff;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto"> <!-- Item di sebelah kiri -->
            <li class="nav-item custom-logo-button">
                <a href="/dashboard" class="navbar-brand">
                    <img  src="{{ asset('assets/logokec.png') }}" alt="Logo" style="height: 50px;">
                </a>
            </li>
            <li class="nav-item custom-judul-button">
                <a class="navbar-brand">Kecamatan Jati</a>
                <!-- Alamat di bawah Unit P3K -->
                <p class="custom-address">Jl. Kudus - Purwodadi No. 93 Kudus 59345</p>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto"> <!-- Menambahkan ms-auto untuk mendorong item ke kanan -->
            <li class="nav-item">
                <form action="/logout" method="POST" class="form-inline custom-logout-button">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
