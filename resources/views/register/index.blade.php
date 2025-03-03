


@extends('layout')

@section('content')
<style>
     .custom-left {
        margin-left: -100px;
    }
</style>
    <div class="container">
        <div class="row custom-left mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>REGISTRASI</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-danger" href="{{ route('surat.create') }}"> Kembali</a>
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

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="row custom-left">
                <div class="col-xs-12 col-sm-12 col-md-12">



                    
        <div class="form-group mb-3">
            <strong for="nik" class="form-label">NIK</strong>
            <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
         </div>
                    
                    
                  



                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group mb-3">
                        <strong>Username :</strong>
                        <input type="text" name="nama_user" class="form-control" placeholder="Username">
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group mb-3">
                        <strong>Email :</strong>
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                </div>
                
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group mb-3">
                        <strong>Password :</strong>
                        <input type="text" name="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group mb-3">
                        <strong>Alamat :</strong>
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
