@extends('layout')

@section('content')

<head>
    <style>
        .custom-left {
            margin-left: -100px;
        }
        .custom-error {
            margin-left: -90px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col-md-6, .col-md-12 {
            padding: 0 15px;
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            border-radius: 10px;
        }
        strong {
            font-weight: bold;
        }
    </style>
</head>

<div class="container">
    <div class="row custom-left">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-left">
                <h2 class="text-center">MASUKKAN DATA</h2>
            </div>
        </div>
    </div>

    {{-- Tampilkan pesan error jika id_user tidak ditemukan --}}
    @if (session('error'))
        <div class="alert alert-danger custom-error">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tampilkan semua error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada Kesalahan dalam Menambahkan Data!<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('suratmasuk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row custom-left">
        
            {{-- Input tersembunyi untuk mengirimkan NIK --}}
            <input type="hidden" id="id_user" name="id_user" value="{{ Auth::user()->nik }}">
            
            {{-- Menampilkan NIK hanya jika user ingin melihatnya (opsional, tidak perlu dikirim) --}}
            @if (Auth::user()->kasta === 'user')
                <p class="form-control-plaintext">{{ Auth::user()->nik }}</p>
            @else
                <input type="hidden" class="form-control" id="id_user_display" value="{{ Auth::user()->nik }}" placeholder="Masukkan NIK">
            @endif

            <div class="col-md-6">
                <div class="form-group">
                    <strong for="nomor_surat2">Nomor Surat:</strong>
                    <input type="text" name="nomor_surat2" class="form-control" placeholder="Nomor Surat" value="{{ old('nomor_surat2') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong for="nama_file">Nama File:</strong>
                    <input type="text" name="nama_file" class="form-control" placeholder="Nama File" value="{{ old('nama_file') }}">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kepada"><strong>Kepada :</strong></label>
                    <select name="kepada" id="kepada" class="form-control">
                        <option value="" disabled selected>Pilih penerima</option>
                        <option value="Camat" {{ old('kepada') == 'Camat' ? 'selected' : '' }}>Camat</option>
                        <option value="Sekretaris Camat" {{ old('kepada') == 'Sekretaris Camat' ? 'selected' : '' }}>Sekretaris Camat</option>
                        <option value="Kestra" {{ old('kepada') == 'Kestra' ? 'selected' : '' }}>Kestra</option>
                    </select>
                </div>
            </div>



            <div class="col-md-6">
                <div class="form-group">
                    <strong for="keterangan">Perihal:</strong>
                    <input type="text" name="keterangan" class="form-control" placeholder="Perihal" value="{{ old('keterangan') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong for="file">File:</strong>
                    <input type="file" name="file" class="form-control" placeholder="File" value="{{ old('file') }}">
                </div>
            </div>

            <div class="col-md-12 mt-4 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>

</div>

@endsection
