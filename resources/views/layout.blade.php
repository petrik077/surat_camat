<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Make sure html and body fill the entire height */
        html, body {
            height: 100%;
            margin: 0;
        }

        /* Flexbox for the content wrapper to make footer always at the bottom */
        .content-wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper > .container-fluid {
            flex: 1;
        }

        /* Footer styles */
        footer {
            background-color: #343a40;
            color: white;
            padding: 5px 0;  /* Smaller padding for a more compact footer */
            text-align: center;
            font-size: 12px; /* Slightly smaller font size */
            margin-top: auto; /* Ensures footer stays at the bottom */
        }

        footer a {
            color: #ffffff;
            text-decoration: none;
        }

        footer a:hover {
            color: #ffc107; /* Hover color */
        }

        /* Navbar and sidebar responsiveness */
        @media (max-width: 768px) {
            .content-wrapper > .container-fluid {
                padding-left: 15px;
                padding-right: 15px;
            }

            footer {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar') <!-- Include Navbar -->

    <!-- Main content wrapper -->
    <div class="content-wrapper">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-md-2">
                    @include('layouts.sidebar') <!-- Include Sidebar -->
                </div>
                <div class="col-md-9">
                    @yield('content') <!-- Placeholder for main content -->
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <p>&copy; 2024 Kantor Kecamatan Jati. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
