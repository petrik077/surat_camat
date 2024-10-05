<style>

body {
    background-color: #f8f9fa; /* Light background color */
    font-family: Arial, sans-serif; /* Clean font */
}

.row {
    height: 100vh; /* Full height */
    align-items: center; /* Center vertically */
}

.form-signin {
    background-color: white; /* White background for the form */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
    padding: 8rem; /* Padding around the form */
}

h1 {
    color: #333; /* Darker text for the heading */
    margin-bottom: 1.5rem; /* Space below the heading */
}

.form-floating {
    margin-bottom: 1rem; /* Space between input fields */
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

.alert {
    margin-bottom: 1rem; /* Space below alerts */
}

</style>





<center>

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
                <h1 class="h3 mb-10 fw-normal text-center">Please Login</h1>

                <form action="/login" method="post">
                    @csrf

                    <label for="email">Email address</label>
                    <div class="form-floating">
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <label for="password">Password</label>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    </div>

                    <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
                </form>

            </main>
        </div>
    </div>

</center>
