<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Dosens\DosenResource;
use App\Filament\Resources\Mahasiswas\MahasiswaResource;
use App\Filament\Resources\Tugas\TugasResource;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatOverview extends StatsOverviewWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalMahasiswa = Mahasiswa::query()->count();
        $totalDosen = Dosen::query()->count();
        $totalTugasAktif = Tugas::query()
            ->where('status', 'aktif')
            ->where('deadline', '>=', now())
            ->count();

        return [
            Stat::make('Total Mahasiswa', $totalMahasiswa)
                ->description('Mahasiswa terdaftar di database')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary')
                ->url(MahasiswaResource::getUrl()),
            Stat::make('Total Staf Dosen', $totalDosen)
                ->description('Dosen wali FTEIC ITS')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->url(DosenResource::getUrl()),
            Stat::make('Total Tugas Aktif', $totalTugasAktif)
                ->description('Tugas aktif yang belum melewati tenggat')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning')
                ->url(TugasResource::getUrl()),
        ];
    }
}
