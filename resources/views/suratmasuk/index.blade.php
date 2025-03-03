@extends('layout')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Surat Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .table th, .table td {
            text-align: center;
        }

        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }

        .action-buttons .btn {
            margin: 0 5px;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Penyesuaian untuk tampilan responsif */
        @media (max-width: 768px) {
            .custom-left {
                margin-left: 0;
            }
            .custom-surat {
                margin-left: 0;
            }
        }

        /* New class for centering the title */
        .page-title {
            text-align: center;
            margin-bottom: 30px; /* Add space below the title */
        }
    </style>
</head>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 margin-tb"> <!-- Updated to col-md-12 for full width -->
            <div class="mb-3 page-title"> <!-- Apply custom page-title class here -->
                <h2>Data Surat Masuk</h2>
            </div>

            @if(Auth()->user()->kasta === 'admin')  
                <div class="text-end mb-3">
                    <a class="btn btn-primary" href="{{ route('suratmasuk.create') }}">Input Surat</a>
                </div>
            @endif
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success custom-left">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-hover custom-left">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Nama File</th>
                <th>Kepada</th>
                <th>Tanggal Masuk</th>
                <th>Jam</th>
                <th>File</th>
                <th>Perihal</th>
                @if(Auth()->user()->kasta === 'admin')  
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($suratmasuks as $suratmasuk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $suratmasuk->nomor_surat2 }}</td>
                    <td>{{ $suratmasuk->nama_file }}</td>
                    <td>{{ $suratmasuk->kepada }}</td>
                    <td>{{ \Carbon\Carbon::parse($suratmasuk->tanggalmasuk)->format('d-m-Y') }}</td> <!-- Tanggal -->
                    <td>{{ \Carbon\Carbon::parse($suratmasuk->tanggalmasuk)->format('H:i:s') }}</td> <!-- Jam -->
                    <td>
                        <a href="{{ asset('storage/suratmasuk/'.$suratmasuk->file) }}" target="_blank" class="btn btn-info btn-sm">Lihat File</a>
                    </td>
                    <td>{{ $suratmasuk->keterangan }}</td>

                    @if(Auth()->user()->kasta === 'admin')  
                        <td class="action-buttons">
                            <form action="{{ route('suratmasuk.delete', $suratmasuk->id_suratmasuk) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin Menghapus Surat?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
