@extends('layout')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Permintaan Surat Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .custom-surat {
            margin-left: -50px;
        }
        .custom-status {
            top: -8px;
        }

        /* Penyesuaian untuk tampilan responsif */
        @media (max-width: 768px) {
            .custom-left {
                margin-left: 0px;
            }
            .custom-surat {
                margin-left: 0px;
            }
        }

        .table th, .table td {
            text-align: center;
        }

        .action-buttons .btn {
            margin: 0 5px;
        }

        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }

        .dropdown-menu {
            min-width: 200px;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            align-items: center;
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
        <div class="col-md-12 margin-tb">
            <div class="mb-3 page-title"> <!-- Updated this div to use the new page-title class -->
                <h2>Data Permintaan Surat Keluar</h2>
            </div>

            @if(Auth()->user()->kasta === 'admin')  
                <div class="text-end mb-3">
                    <a class="btn btn-primary" href="{{ route('surat.create') }}">Buat Surat</a>
                </div>
            @endif
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success custom-left">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger custom-left">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-hover custom-left">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Kepada</th>
                <th>Jenis Surat</th>
                <th>Perihal</th>
                <th>File</th>
                <th>Tanggal Buat</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surats as $surat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $surat->jenisSurat?->kodesurat ?? 'N/A' }}/{{ $surat->nomor_surat2 }}
                    </td>
                    <td>{{ $surat->kepada }}</td>
                    <td>{{ $surat->jenisSurat?->jenissurat}} </td>
                    <td>{{ $surat->keterangan }}</td>
                    <td>
                        <a href="{{ asset('storage/files/'.$surat->file) }}" target="_blank" class="btn btn-info btn-sm">Lihat File</a>
                    </td>
                    <td>{{ $surat->created_at->format('d-m-Y') }}</td>
                    
                    

                    <td>
                        @if($surat->status === 'Disetujui')
                            <span class="badge bg-success">{{ $surat->status }}</span>
                        @elseif($surat->status === 'Tidak Disetujui')
                            <span class="badge bg-danger">{{ $surat->status }}</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ $surat->status }}</span>
                        @endif
                    </td>








                    <td class="action-buttons">
                        @if(Auth()->user()->kasta === 'admin')  
                        @if($surat->status !== 'Disetujui' && $surat->status !== 'Tidak Disetujui')
                        <a href="{{ route('surat.edit', $surat->nomor_surat) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endif
                            <form action="{{ route('surat.delete', $surat->nomor_surat) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin Menghapus Surat?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @endif

                        @if(Auth()->user()->kasta === 'camat')  
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ubah Status
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('surat.setuju', $surat->nomor_surat) }}">Setuju</a>
                                    <a class="dropdown-item" href="{{ route('surat.tdksetuju', $surat->nomor_surat) }}">Tidak Setuju</a>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
