@extends('layout')



@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                <center>
                    <h2>DATA KESEHATAN PEGAWAI</h2>
                    </center>    
                </div>

                
                <div class="row">
    <div class="col-md-6">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('surat.create') }}"> Buat Surat</a>
        </div>
    </div>
    <div class="col-md-6">
        <form action="/logout" method="POST">
            @csrf
        </form>
    </div>
</div>

                
            </div>
        </div>
        

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>NIK</th>
                <th>Nama File</th>
                <th>Perihal</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($surats as $surat)
                <tr>
                    <td>{{ $surat->id }}</td>
                    <td>{{ $surat->nomor_surat }}</td>
                    <td>{{ $surat->id_user }}</td>
                    <td>{{ $surat->nama_file }}</td>
                    <td>{{ $surat->keterangan }}</td>

                    <td>
                        <form action="{{ route('surat.destroy', $surat->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('surat.show', $surat->id) }}">Detail</a>
                            <a class="btn btn-primary" href="{{ route('surat.edit', $surat->id) }}">Ubah</a>
                            
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus Data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
