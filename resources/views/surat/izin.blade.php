<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Permohonan Izin PKL</title>
    <style>
        @page {
            size: A4;
            margin: 2cm 2.5cm 2.5cm 2.5cm;        
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            text-align: justify;
        }
        p {
            text-indent: 1.2cm;
            margin: 0 0 12pt 0;
        }
         .no-indent {
            text-indent: 0;
        }
        /* .kop-text h3, .kop-text h4 {
            margin: 0;
        }
        .kop-text .desc {
            font-size: 12px;
            margin-top: 5px;
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

<!-- KOP SURAT -->
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


<br>

<!-- INFORMASI SURAT -->
<table style="margin-bottom: 20px;">
    <tr>
        <td style="width: 100px;">Nomor</td>
        <td>: {{ $nomor_surat_izin }}</td>
    </tr>
    <tr>
        <td>Lampiran</td>
        <td>: Gabung</td>
    </tr>
    <tr>
        <td>Hal</td>
        <td>: <u><strong>Permohonan Ijin Praktik Kerja Lapangan (PKL)</strong></u></td>
    </tr>
</table>


<!-- TUJUAN SURAT -->
<div class="tujuan-surat">
  Kepada Yth:<br>
    Pimpinan Kantor {{ $pengajuan->nama_instansi }}<br>
    di-<br>
</div>
<p> {{ $pengajuan->alamat_instansi }}
</p>

<!-- ISI SURAT -->
<p class="no-indent">Assalamu’alaikum Wr. Wb</p>

<p>
    Sehubungan dengan ketentuan kurikulum berbasis kompetensi, maka mahasiswa S1 
    {{ $pengajuan->mahasiswa->prodi->nama }} Fakultas Sains dan Teknologi Universitas 
    Qamarul Huda Badaruddin Bagu diwajibkan untuk menguasai teori dan praktik yang dilandasi 
    sikap etis dan profesional. Untuk memenuhi tuntutan tersebut, mahasiswa harus menjalani 
    kegiatan Praktik Kerja Lapangan (PKL).
</p>

<p>
    Maka dari itu kami menyampaikan permohonan untuk mempraktikkan mahasiswa S1 
    {{ $pengajuan->mahasiswa->prodi->nama }} Fakultas Sains dan Teknologi Universitas 
    Qamarul Huda Badaruddin Bagu pada kantor {{ $pengajuan->nama_instansi }} 
    {{ $pengajuan->alamat_instansi }} dengan rincian sebagai berikut:
</p>

<p class="no-indent">
1. Mahasiswa Program Studi S1 Teknologi Informasi Semester VII sebanyak {{ count($mahasiswas) }} orang (terlampir)<br>
2. Waktu Pelaksanaan dimulai pada tanggal <strong>{{ $tanggal_mulai }} s/d {{ $tanggal_selesai }}</strong>
</p>

<p>Demikian dan mohon jawaban atas kerjasamanya disampaikan terima kasih.</p>

<p>Wassalamu’alaikum Wr. Wb</p>

<br>
<br>
<br>
<h4>Nama Mahasiswa Terlampir</h4>
<table class="table" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Prodi</th>
            <th>Nama Mahasiswa</th>
            <th>Semester</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mahasiswas as $i => $mhs)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->prodi->nama }}</td>
                <td>{{ $mhs->user->name }}</td>
                <td>VII</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- TANDA TANGAN -->
@php
    $prodiName = $kaprodi->prodi->nama;

    // Mapping nama prodi ke nama file TTD dan barcode
    $fileMap = [
        'Teknologi Informasi' => 'TI.png',
        'Ilmu Komputer' => 'Ilkom.png',
        'Teknik Sipil' => 'Sipil.png',
    ];

    $ttdFile = isset($fileMap[$prodiName]) ? public_path('ttd/' . $fileMap[$prodiName]) : null;
@endphp

<div class="signature">
 
   <p>Bagu, {{ $tanggal }}<br>
    @if ($ttdFile && file_exists($ttdFile))
        <img src="{{ $ttdFile }}" alt="Tanda Tangan" style="width:50%; height:auto;"><br>
    @endif
    
    Kaprodi {{ $prodiName }} <br>
    <strong>{{ $kaprodi->user->name}}</strong><br>
    NIDN: {{ $kaprodi->nidn }}
    </p>
</body>
</html>
