@extends('layout')

@section('content')

<style>
    .form-group {
        margin-bottom: 20px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .col-md-6 {
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

    /* Membuat style readonly agar lebih jelas */
    .readonly-input {
        background-color: #f8f9fa;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <h2 class="text-center">TAMBAH JENIS SURAT</h2>
        </div>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

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

    <form action="{{ route('jenissurat.store') }}" method="POST">
        @csrf

            <div class="col-md-6">
                <div class="form-group">
                    <strong for="jenissurat">Jenis Surat:</strong>
                    <input type="text" name="jenissurat" class="form-control" value="{{ old('jenissurat') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong for="kodesurat">Kode Surat:</strong>
                    <input type="text" name="kodesurat" class="form-control" value="{{ old('kodesurat') }}">
                </div>
            </div>

          

            <div class="col-md-12 text-center mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>

@endsection
