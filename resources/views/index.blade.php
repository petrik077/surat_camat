<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
            background-image: url('/assets/images/background2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif; /* Clean font */
        }

        .row {
            height: 100vh; /* Full height */
            align-items: center; /* Center vertically */
        }

        .form-signin {
            background-color: rgba(255, 255, 255, 0.4); /* White with 60% transparency */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 4rem; /* Reduced padding for a more proportional box */
            max-width: 400px; /* Adjust the width to be more appropriate */
            margin-top: 100px; /* Center the box vertically */
        }
        .form-floating {
            position: relative;
            margin-bottom: 1rem;

        }

        h1 {
            color: #333; /* Darker text for the heading */
            margin-bottom: 1.5rem; /* Space below the heading */
        }

        .form-group {
            margin-bottom: 0.5rem; /* Space between input fields */
        }

        .form-control {
            padding: 0.75rem;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #007bff; /* Bootstrap primary color */
            border: none; /* Remove border */
            padding: 1rem; /* Increase vertical padding */
            font-size: 1.2rem; /* Increase font size */
            border-radius: 5px; /* Slightly round corners */
            transition: background-color 0.3s ease; /* Smooth transition for hover effect */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker shade on hover */
            
        }
        .register:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }

        .alert {
            margin-bottom: 1rem; /* Space below alerts */
        }


        .custom-logo-button {
    list-style: none; /* Menghilangkan bullet point */
}

.custom-logo-button::marker {
    content: ''; /* Menghapus konten marker */
}

    </style>
</head>
<center>

    <body>
        
        <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                
                <main class="form-signin w-100 m-auto">
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    
                    @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                    </div>
                    @endif

                    <li class="custom-logo-button">
                        <a>
                            <img  src="{{asset('assets/logokec.png') }}" alt="Logo" style="height: 150px;">
                        </a>
                    </li>
                    <h1 class="h3 mb-10 fw-normal text-center">Please Login</h1>
                    
                    <form action="/login" method="post">
                        @csrf
                        
                        <div class="form-group">
                            <strong for="email">Email address</strong>
                            <div class="form-floating">
                                <input style="border-radius: 8px;" type="text" name="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <strong for="password">Password</strong>
                            <div class="form-floating">
                                <input style="border-radius: 8px;" type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
                        <!-- <p class="text-center mt-3">Belum punya akun? <a class="register" href="{{ route('registrasi.index') }}">Registrasi</a></p> -->
                    </form>

                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</center>
</html>
