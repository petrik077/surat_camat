<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('/assets/images/background2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

        .row {
            height: 100vh;
            align-items: center;
        }

        .form-signin {
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 4rem;
            max-width: 400px; /* Atur lebar maksimum kotak */
            margin-top: 100px;
        }

        h1 {
            color: #333;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 0.5rem; /* Tambahkan jarak antar input */
        }

        .form-control {
            padding: 0.75rem;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 1rem;
            font-size: 1.2rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <main class="form-signin w-100 m-auto">
                    <h1 class="h3 mb-10 fw-normal text-center">Registrasi</h1>

                    <form action="{{ route('register.store2') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <strong>NIK :</strong>
                            <input type="text" name="nik" class="form-control" placeholder="NIK" required>
                        </div>

                        <div class="form-group">
                            <strong>Nama :</strong>
                            <input type="text" name="nama_user" class="form-control" placeholder="Nama" required>
                        </div>

                        <div class="form-group">
                            <strong>Alamat :</strong>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                        </div>

                        <div class="form-group">
                            <strong>Email :</strong>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <label for="password"><strong>Password :</strong></label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        </div>

                        <button class="btn btn-primary w-100 py-2" type="submit">Simpan</button>
                        <p class="text-center mt-3">Sudah punya akun? <a href="/">Login</a></p>
                    </form>

                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
