@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Detail</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('surat.index') }}"> Kembali</a>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>NIK :</strong>
                    {{ $surat->id_user }}
                </div>
            </div>



            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor Surat:</strong>
                    {{ $surat->nomor_surat }}
                </div>
            </div>




            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama File :</strong>
                    {{ $surat->nama_file }}
                </div>
            </div>




            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Perihal :</strong>
                    {{ $surat->keterangan }}
                </div>
            </div>




            



        </div>
    </div>
@endsection
