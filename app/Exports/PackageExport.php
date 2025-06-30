<?php

namespace App\Exports;

use App\Models\Package;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PackageExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Package::with(['position', 'courier', 'handler'])
            ->whereDate('created_at', Carbon::today())
            ->get()
            ->map(function ($package) {
                return [
                    'Tanggal'       => $package->created_at->format('d/m/Y'),
                    'Unit'          => $package->unit,
                    'Pengirim'      => $package->pengirim,
                    'Kurir'         => $package->courier ? $package->courier->nama : 'No Kurir',
                    'Penerima'      => $package->penerima,
                    'Deskripsi'     => $package->deskripsi,
                    'Petugas'       => $package->handler ? $package->handler->nama : 'No Petugas',
                    'Posisi'        => $package->position ? $package->position->nama : 'No Posisi',
                    'Catatan'       => $package->catatan,
                    'Tanggal Diambil' =>$package->updated_at->format('d/m/Y'),
                    'Jam Diambil'     =>$package->updated_at->format('H:i'),
                ];
            });
    }

    public function headings(): array
    {
        return ['Tanggal', 'Unit', 'Pengirim', 'Kurir', 'Penerima', 'Deskripsi', 'Petugas', 'Posisi', 'Catatan', 'Tanggal Diambil', 'Jam Diambil'];
    }
}
