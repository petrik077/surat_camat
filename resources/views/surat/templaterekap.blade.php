<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            flex-direction: column;
            line-height: 1.6;
        }
        .container {
            flex: 1;
            margin: 20px;
        }
        .header {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }
        .header > div {
            margin-bottom: 10px;
        }
        .header p {
            margin: 0;
        }
        .content {
            margin-top: 0px;
            margin-bottom: 50px;
            gap: 0px;
        }
        .content h3 {
            margin-bottom: 10px;
            text-decoration: underline;
        }
        .p {
            line-height: 1;
            text-align: left;
        }
        .p2 {
            line-height: 1.5;
            text-align: left;
        }
        .deskripsi {
            line-height: 1.5;
            word-wrap: break-word;
            word-break: break-word;
            text-align: justify;
            text-indent: 30px;
        }
        .custom-atas {
            line-height: 0.5;
            margin-top: -15px;
            text-indent: 30px;
        }
        .footer {
            text-align: right;
            padding: 10px 20px;
            padding-bottom: 50px; /* Jarak tambahan bawah */
            background-color: white;
        }
        .header-img {
            height: 0px;
            margin-top: 10px;
            margin-left: 80px;
        }

        @media print {
            @page {
                margin: 50px; /* Margin untuk semua halaman */
            }
            body {
                margin: 0px; /* Margin body secara keseluruhan */
            }
            .deskripsi {
                margin-top: 0px; /* Margin atas untuk teks deskripsi */
            }
            .footer {
                page-break-inside: avoid; /* Hindari pemutusan halaman di footer */
                padding-bottom: 100px; /* Jarak tambahan untuk cetakan */
            }
        }
    </style>
</head>
<body>

    <a class="header-img">
        <img src="{{ asset('assets/logokec.png') }}" alt="Logo" style="height: 120px;">
    </a>

    <center>
        <div class="custom-atas">
            <h3>PEMERINTAH KABUPATEN KUDUS</h3>
            <h4>KECAMATAN JATI</h4>
            <p>Jalan Purwodadi No. 93 Telp. (0291) 437565</p>
            <p>KUDUS 59371</p>
            <p>Email: - Website: jati.kuduskab.go.id</p>
            <hr style="border: 2px solid black; width: 97%; margin: 20px auto;">
            <p style="text-align: right; margin-right:70px;">Kudus, <b>{{ date('d-m-Y', strtotime($rekap->created_at)) }}</b></p>
            </div>
    </center>

    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div class="p">
                <p><strong>Nomor Surat: {{ $rekap->nomor_surat2 }}</strong></p>
                <p><strong>Lampiran:</strong> -</p>
                <p><strong>Perihal: {{ $rekap->keterangan }}</strong></p>
            </div>
            
            <div class="p2" style="text-align: right;">
                <p>
                    <strong  style="margin-right:79px;">KEPADA YTH,</strong><br>
                    <span style="margin-right:81px; display: inline-block; max-width: 150px; word-wrap: break-word; word-break: break-word; text-align: left;">{{ $rekap->kepada }}</span><br>
                    <strong style="margin-right:110px;">Di Tempat</strong><br>
                </p>
            </div>
        </div>

        <div class="deskripsi" style="margin-top:30px;">
            @foreach (explode("\n", $rekap->deskripsi) as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>
    </div>

    <div class="footer">
        <p style="margin-bottom:80px; margin-right:120px;"><strong>Hormat kami,</strong></p>
        <p style="margin-right:70px;"><strong>FIZA AKBAR, S. STP, M.Si</strong></p>
        <p style="margin-right:65px;">NIP. 19840917 200212 1 001</p>
    </div>
</body>
</html>

<script>
    window.onload = function() {
        const statusSurat = @json($rekap->status); // Status surat dari server
        if (statusSurat === 'Disetujui') {
            setTimeout(() => {
                window.print(); // Delay untuk memastikan layout selesai
            }, 500);
        }
    };
</script>
