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
            <h2 class="text-center">EDIT SURAT</h2>
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

    <form action="{{ route('surat.update', $surat->nomor_surat) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Atau @method('PATCH') -->


        {{-- Input tersembunyi untuk mengirimkan NIK --}}
        <input type="hidden" id="id_user" name="id_user" value="{{ Auth::user()->nik }}">

        {{-- Menampilkan NIK hanya jika user ingin melihatnya (opsional, tidak perlu dikirim) --}}
        @if (Auth::user()->kasta === 'user')
            <p class="form-control-plaintext">{{ Auth::user()->nik }}</p>
        @else
            <input type="hidden" class="form-control" id="id_user_display" value="{{ Auth::user()->nik }}" placeholder="Masukkan NIK">
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="jenissurat"><strong>Jenis Surat:</strong></label>
                    <select class="form-select" id="jenissurat" name="jenissurat">
                        <option value="" disabled>Pilih Jenis Surat</option>
                        @foreach($jenissurats as $jenissurat)
                            <option value="{{ $jenissurat->id_jenissurat }}" 
                                    data-kodesurat="{{ $jenissurat->kodesurat }}"
                                    @if($surat->jenissurat_id == $jenissurat->id_jenissurat) selected @endif>
                                {{ $jenissurat->jenissurat }}
                            </option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong for="nomor_surat2">Nomor Surat:</strong>
                    <div class="input-group">
                        <span class="input-group-text" id="kode_surat_prefix" readonly>
                            {{ old('kodesurat', $surat->jenisSurat->kodesurat ?? '') }}
                        </span>
                        <input type="text" name="nomor_surat2" id="nomor_surat2" class="form-control" value="{{ old('nomor_surat2', $surat->nomor_surat2) }}">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="kepada"><strong>Kepada :</strong></label>
                    <select name="kepada" id="kepada" class="form-control">
                        <option value="" disabled selected>Pilih penerima</option>
                        <option value="Camat" {{ old('kepada', $surat->kepada) == 'Camat' ? 'selected' : '' }}>Camat</option>
                        <option value="Sekretaris Camat" {{ old('kepada', $surat->kepada) == 'Sekretaris Camat' ? 'selected' : '' }}>Sekretaris Camat</option>
                        <option value="Kestra" {{ old('kepada', $surat->kepada) == 'Kestra' ? 'selected' : '' }}>Kestra</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong for="nama_file">Nama File:</strong>
                    <input type="text" name="nama_file" class="form-control" value="{{ old('nama_file', $surat->nama_file) }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong for="keterangan">Perihal:</strong>
                    <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan', $surat->keterangan) }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong for="file">File:</strong>
                    <input type="file" name="file" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                    @if ($surat->file)
                        <div class="mt-2">
                            <a href="{{ asset('storage/files/' . $surat->file) }}" target="_blank">Lihat File Lama</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-12 text-center mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Fungsi untuk memperbarui kode surat saat dropdown jenis surat berubah
    $('#jenissurat').change(function() {
        var kodesurat = $(this).find(':selected').data('kodesurat');  // Ambil kodesurat dari data-atribut
        if (kodesurat) {
            $('#kode_surat_prefix').text(kodesurat + "/");  // Update prefix
            $('#nomor_surat2').val('');  // Kosongkan nomor surat untuk memasukkan nomor baru
        } else {
            $('#kode_surat_prefix').text('');  // Jika tidak ada, kosongkan
            $('#nomor_surat2').val('');
        }
    });

    // Memicu event change untuk menampilkan kode surat pada saat halaman dimuat pertama kali
    $('#jenissurat').trigger('change');  // Men-trigger change untuk set kode surat awal
});


</script>

@endsection
