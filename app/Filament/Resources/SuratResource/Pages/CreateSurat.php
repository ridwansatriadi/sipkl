<?php

namespace App\Filament\Resources\SuratResource\Pages;

use App\Filament\Resources\SuratResource;
use App\Models\Surat;
use App\Models\Mahasiswa;
use Filament\Resources\Pages\CreateRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Filament\Facades\Filament;

class CreateSurat extends CreateRecord
{
    protected static string $resource = SuratResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data ['tanggal_terbit'] = now();
         return [
        ...$data,
        'tanggal_terbit' => now(),
    ];
    }

    protected function afterCreate(): void
    {
        $record = $this->record;
        $pengajuan = $record->pengajuan;
    
        if (!$pengajuan) {
            dd("Pengajuan tidak ditemukan.");
        }
    
        $kaprodi = Filament::auth()->user()->kaprodi;
    
        $mahasiswas = Mahasiswa::whereHas('pengajuans', function ($query) use ($pengajuan) {
            $query->where('nama_instansi', $pengajuan->nama_instansi)
                  ->where('alamat_instansi', $pengajuan->alamat_instansi);
        })->with('user')->get();
    
        // Buat nomor surat lebih awal
        $lastNumber = Surat::whereYear('tanggal_terbit', now()->year)->count();
        $bulanRomawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
            5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
            9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
        ];
        
        //no surat izin
        $kodeProdi = $kaprodi->prodi->kode;
        $nomorSuratIzin = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT)
            . "/{$kodeProdi}-FST.UNIQHBA/YP2QH/" . $bulanRomawi[now()->month] . "/" . now()->year;
    
        // Tetapkan nilai ini langsung ke record (untuk digunakan di PDF)
        $record->nomor_surat_izin = $nomorSuratIzin;

        // no surat jalan
        $nomorSuratJalan = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT)
            . "/m.pkl/FST.UNIQHBA/" . $bulanRomawi[now()->month] . "/" . now()->year;
    
        // Tetapkan nilai ini langsung ke record (untuk digunakan di PDF)
        $record->nomor_surat_jalan= $nomorSuratJalan;

        // no surat penarikan
        $nomorSuratPenarikan = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT)
            . "/PKL/{$kodeProdi}.FST.UNIQHBA/" . $bulanRomawi[now()->month] . "/" . now()->year;
    
        // Tetapkan nilai ini langsung ke record (untuk digunakan di PDF)
        $record->nomor_surat_penarikan= $nomorSuratPenarikan;
    
    
        // Tentukan template surat
        $template = match ($record->jenis_surat) {
            'Surat Permohonan Izin' => 'surat.izin',
            'Surat Jalan' => 'surat.jalan',
            'Surat Penarikan' => 'surat.penarikan',
            default => abort(404, 'Template surat tidak ditemukan'),
        };
    
        $tanggalMulai = Carbon::parse($record->tanggal_mulai)->translatedFormat('d F Y');
        $tanggalSelesai = Carbon::parse($record->tanggal_selesai)->translatedFormat('d F Y');        
        $tanggalTerbit = optional($record->tanggal_terbit)->translatedFormat('d F Y') ?? now()->translatedFormat('d F Y');
    
        try {
            $pdf = Pdf::loadView($template, [
                'pengajuan' => $pengajuan,
                'kaprodi' => $kaprodi,
                'record' => $record,
                'mahasiswas' => $mahasiswas,
                'tanggal' => $tanggalTerbit,
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai,
                'nomor_surat_izin' => $nomorSuratIzin,
                'nomor_surat_jalan' => $nomorSuratJalan,
                'nomor_surat_penarikan' => $nomorSuratPenarikan,
            ]);
        } catch (\Throwable $e) {
            dd("PDF error: " . $e->getMessage());
        }
    
        $filename = 'surat-' . Str::slug($record->jenis_surat) . '-' .
                    Str::slug($pengajuan->mahasiswa->user->name ?? 'mahasiswa') . '-' .
                    time() . '.pdf';
    
        Storage::disk('public')->makeDirectory('surat');
        Storage::disk('public')->put('surat/' . $filename, $pdf->output());
    
        // Simpan ke database
        $record->update([
            'file_surat' => 'surat/' . $filename,
            'nomor_surat_izin' => $nomorSuratIzin,
            'nomor_surat_jalan' => $nomorSuratJalan,
            'nomor_surat_penarikan' => $nomorSuratPenarikan,
        ]);
    }    
}
