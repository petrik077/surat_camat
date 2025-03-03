@extends('layout')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jenis Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        .custom-left {
            margin-left: -100px;
        }
        .custom-surat {
            margin-left: -100px;
        }
        .custom-status {
            top: -8px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .search-box {
            margin-bottom: 20px;
        }
        .alert-custom {
            margin-top: 20px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <div class="card p-4">
                <center>
                    <h2 class="mb-4">Jenis Surat</h2>
                </center>    


                @if(Auth()->user()->kasta === 'admin')  
                <div class="text-end mb-3">
                    <a class="btn btn-primary" href="{{ route('jenissurat.create') }}">Buat Jenis</a>
                </div>
            @endif


                <!-- Form Pencarian -->
                <div class="row search-box">
                    <form action="{{ route('jenissurat.index') }}" method="GET">
                        <div class="col-md-8">
                            <input type="text" name="search" class="form-control" placeholder="Cari Jenis Surat" value="{{ request()->get('search') }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    </form>
                </div>

                <!-- Tampilkan pesan jika ada -->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-custom">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-custom">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Jenis Surat</th>
                                <th>Kode Surat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jenissurats as $jenissurat)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jenissurat->jenissurat }}</td>
                                    <td>{{ $jenissurat->kodesurat }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger">Tidak ada surat yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
