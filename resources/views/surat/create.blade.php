@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>MASUKKAN DATA</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('surat.index') }}"> Kembali</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Ada Kesalahan dalam Menambahkan Data!.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('surat.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">



                    <div class="form-group">
                        <strong>Nomor Surat :</strong>
                        <input type="string" name="nomor_surat" class="form-control" placeholder="Nomor Surat">
                    </div>
                </div>
                
                
                
                

                <div class="mb-3">
    <label for="id_user" class="form-label">ID User</label>
    @foreach($users as $user)
        <input value="{{ $user->id_user }}" type="text" class="form-control" id="id_user" name="id_user" readonly>
    @endforeach
</div>


                
                

                







                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama File :</strong>
                        <input type="text" name="nama_file" class="form-control" placeholder="Nama File">
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Perihal :</strong>
                        <input type="string" name="keterangan" class="form-control" placeholder="Perihal">
                    </div>
                </div>



                



                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
