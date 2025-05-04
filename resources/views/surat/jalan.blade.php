<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Surat Jalan PKl</title>
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
            margin-top: 40px;
            text-align: right;
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


<div style="text-align: center;" >
    <h5><u>SURAT JALAN PRAKTIK KERJA LAPANGAN (PKL)</u><br></h5>
Nomor: {{ $nomor_surat_jalan }}
</div>

<p>Yang bertanda tangan di bawah ini:</p>
<table style="margin-bottom: 13px;">
    <tr>
        <td>Nama</td>
        <td>: {{ $kaprodi->user->name}} </td>
    </tr>
    <tr>
        <td>NIDN</td>
        <td>: {{ $kaprodi->nidn }} </td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>: Ketua Program Studi {{ $kaprodi->prodi->nama }} </td>
    </tr>
</table>

<p>Menerangkan bahwa mahasiswa berikut ini:</p>
<table class="table" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Prodi</th>
            <th>Nama Mahasiswa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mahasiswas as $i => $mhs)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->prodi->nama }}</td>
                <td>{{ $mhs->user->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<p>Telah diberikan izin untuk melaksanakan Praktek Kerja Lapangan (PKL) di {{ $pengajuan->nama_instansi }}.</p>
<p>Adapun Praktek Kerja Lapanagan (PKL) ini dilaksanakan pada:</p>
<table style="margin-bottom: 13px;">
    <tr>
        <td>Tanggal Mulai</td>
        <td>: {{ $tanggal_mulai }} </td>
    </tr>
    <tr>
        <td>Tanggal Selesai</td>
        <td>: {{ $tanggal_selesai }} </td>
    </tr>
   </table>

<p>Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
<p style="font-size: 12px; font-family: 'Courier New', Courier, monospace;">
    [DIVERIFIKASI: {{ now()->format('d F Y H:i:s') }}]
</p>

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
    Ketua Program Studi {{ $prodiName }} <br><br>

    @if ($ttdFile && file_exists($ttdFile))
        <img src="{{ $ttdFile }}" alt="Tanda Tangan" style="width:50%; height:auto;"><br>
    @endif

    <strong>Universitas Qamarul Huda Badaruddin Bagu</strong><br>
    <strong>{{ $kaprodi->user->name}}</strong><br>
    NIDN: {{ $kaprodi->nidn }}
    </p>

    @if ($barcodeFile && file_exists($barcodeFile))
        <div class="qr" style="margin-top: 10px;">
            <img src="{{ $barcodeFile }}" alt="QR Code" style="width:80px; height:auto;">
        </div>
    @endif
</div>
</body>
</html>
