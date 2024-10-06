@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>UBAH DATA</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('surat.index') }}"> Kembali</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Ada Kesalahan dalam Mengubah Data!<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('surat.update', $surat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">



                        <strong>Nama Pasien:</strong>
                        <input type="string" name="namapasien" value="{{ $surat->namapasien }}" class="form-control" placeholder="Nama Pasien">
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>Jenis Kelamin:</strong>
    <select class="form-control" aria-label="Floating label select example" id="jeniskelamin" name="jeniskelamin">
      <option disabled selected>Pilih</option>
      <option value="Laki-laki">Laki-laki</option>
      <option value="Perempuan">Perempuan</option>
    </select>
</div>



                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Umur :</strong>
                        <textarea class="form-control" style="height:40px" name="umur" placeholder="Umur">{{ $surat->umur }}</textarea>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Keluhan :</strong>
                        <textarea class="form-control" style="height:40px" name="keluhan" placeholder="Keluhan">{{ $surat->keluhan }}</textarea>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Obat :</strong>
                        <textarea class="form-control" style="height:40px" name="obat" placeholder="Obat">{{ $surat->obat }}</textarea>
                    </div>
                </div>




                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
