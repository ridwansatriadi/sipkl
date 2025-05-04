<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Surat Penarikan</title>
    <style>
        @page {
            size: A4;
            margin: 2cm 2.5cm 2.5cm 2.5cm;        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            text-align: justify;
         
        }
        p {
            margin-top: 3pt;
            margin-bottom: 3pt;
        }

         /* .no-indent {
            text-indent: 0;
        } */
        .table, .table th, .table td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 4px;
        }
        .signature {
            margin-top: 30px;
            margin-left: 50%;
            border-collapse: collapse;
        }
     
    </style>
</head>
<body>

<table width="100%" style="margin-top: 0; border-bottom: dimgrey; border-bottom: 4px solid black;">
        <td width="10%" style="text-align: center;">
            <img src="{{ public_path('image/uniqhba.png') }}" width="100">
        </td>
        <td style="text-align: center;">
            <div style="font-size: 15px;">YAYASAN PONDOK PESANTREN QAMARUL HUDA</div>
            <div style="font-size: 18px; font-weight: bold;">UNIVERSITAS QAMARUL HUDA BADARUDDIN</div>
            <div style="font-size: 18px; color: #003366; font-weight: bold;">FAKULTAS SAINS DAN TEKNOLOGI</div>
            <div style="font-size: 12px; font-weight: bold;">Nomor Izin Pendirian: 612/KPT/I/2017</div>
            <div style="font-size: 11px; font-style: italic;">
                Jl. H. Badaruddin Bagu - Pringgarata - Lombok Tengah - NTB Tlp. (370) 7564597 Kode Pos 83561<br>
                email: kontak@uniqhba.ac.id | website: www.uniqhba.ac.id
            </div>
        </td>
</table>

<table style="width: 100%; margin-bottom: 12px;">
    <tr>
        <td style="width: 70%;">
            Nomor : {{ $nomor_surat_penarikan }}
        </td>
        <td style="width: 30%; text-align: right;">
            Bagu, {{ now()->format('d F Y') }}
        </td>
    </tr>
    <tr>
        <td>
            Perihal : Penarikan Mahasiswa PKL
        </td>
        <td></td>
    </tr>
</table>


</table>
<p>Yth,</p>
<p>Kepala {{ $pengajuan->nama_instansi }}</p>
<p style="margin-bottom: 12px;">di {{ $pengajuan->alamat_instansi }} </p>
<p style="margin-bottom: 12px;">Dengan Hormat,</p>

<p style="margin-bottom: 12px;">Berdasarkan kegiatan Praktek Kerja Lapangan (PKL) yang dilakukan oleh mahasiswa kami di 
{{ $pengajuan->nama_instansi }}, mulai tanggal {{ $tanggal_mulai }} s/d {{ $tanggal_selesai }}.</p>

<p>Bersama ini kami menginformasikan bahwa mahasiswa kami atas nama :</p>
<table class="table" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Prodi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mahasiswas as $i => $mhs)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->user->name }}</td>
                <td>{{ $mhs->prodi->nama }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<p style="margin-bottom: 12px;">Telah mencapai masa akhir dari kegiatan Praktek Kerja Lapangan. Melalui surat ini kami menginformasikan kepada Bapak/Ibu bahwa mahasiswa tersebut akan dikembalikan lagi ke kampus untuk melanjutkan kegiatan akademik di Universitas.</p>

<p>Demikian surat penarikan mahasiswa PKL ini kami buat. Atas kerjasama dan bimbingan yang telah diberikan, kami ucapkan terima kasih.</p>
@php
    $prodiName = $kaprodi->prodi->nama;

    // Mapping nama prodi ke nama file TTD dan barcode
    $fileMap = [
        'Teknologi Informasi' => 'TI.png',
        'Ilmu Komputer' => 'Ilkom.png',
        'Teknik Sipil' => 'Sipil.png',
    ];

    $ttdFile = isset($fileMap[$prodiName]) ? public_path('ttd/' . $fileMap[$prodiName]) : null;
    $barcodeFile = isset($fileMap[$prodiName]) ? public_path('barcode/' . $fileMap[$prodiName]) : null;
@endphp

<div class="signature">
    <p>Hormat kami,<br>
    Ketua Program Studi {{ $prodiName }} <br>
    <p>Universitas Qamarul Huda Badaruddin Bagu</p><br>

    @if ($ttdFile && file_exists($ttdFile))
        <img src="{{ $ttdFile }}" alt="Tanda Tangan" style="width:70%; height:auto;"><br>
    @endif

    <strong>{{ $kaprodi->user->name}}</strong><br>
    NIDN: {{ $kaprodi->nidn }}
    </p>

    @if ($barcodeFile && file_exists($barcodeFile))
        <div class="qr" style="margin-top: 10px;">
            <img src="{{ $barcodeFile }}" alt="QR Code" style="width:80px; height:auto;">
        </div>
    @endif
</div>
<p style="font-size: 15px; font-family: 'Courier New', Courier, monospace;">
    [DIVERIFIKASI: {{ now()->format('d F Y H:i:s') }}]
</p>
</body>
</html>
