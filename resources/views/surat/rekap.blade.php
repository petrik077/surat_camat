@extends('layout')

@section('content')

<style>
    .custom-left {
        margin-left: 0; /* Adjusted for uniformity */
    }
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

    /* Styling for page title */
    .page-title {
        text-align: center;
        margin-bottom: 30px; /* Add space below the title */
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 margin-tb"> <!-- Adjusted to full width -->
            <div class="mb-3 page-title"> <!-- Apply page-title class for centering -->
                <h2>DATA REKAP SURAT KELUAR</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-hover custom-left">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Kepada</th>
                <th>Nama File</th>
                <th>Jenis Surat</th>
                <th>Tanggal Buat</th>
                <th>Perihal</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekaps as $rekap)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rekap->jenisSurat?->kodesurat ?? 'N/A' }}/{{ $rekap->nomor_surat2 }} </td>
                    </td>
                    <td>{{ $rekap->kepada }}</td>
                    <td>{{ $rekap->nama_file }}</td>
                    <td>{{ $rekap->jenissurat }}</td>
                    <td>{{ $rekap->created_at->format('d-m-Y') }}</td> <!-- Format Tanggal -->
                    <td>{{ $rekap->keterangan }}</td>



                    <td>
                        @if($rekap->status === 'Disetujui')
                            <span class="badge bg-success">{{ $rekap->status }}</span>
                        @elseif($rekap->status === 'Tidak Disetujui')
                            <span class="badge bg-danger">{{ $rekap->status }}</span>
                        @else
                            <span cla`ss="badge bg-warning text-dark">{{ $rekap->status }}</span>
                        @endif
                    </td>
                    
                    
                    
                    
                    
                    <td>
                        <a href="{{ asset('storage/files/'.$rekap->file) }}" target="_blank" class="btn btn-success btn-sm">Lihat Surat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
