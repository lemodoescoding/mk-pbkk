<?php

namespace App\Filament\Pages;

use App\Models\Mahasiswa;
use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;

class PencarianMahasiswa extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMagnifyingGlass;

    protected static string|\UnitEnum|null $navigationGroup = 'Data Akademik';

    protected static ?string $navigationLabel = 'Pencarian Mahasiswa';

    protected static ?string $title = 'Pencarian & Filter Mahasiswa';

    protected string $view = 'filament.pages.pencarian-mahasiswa';

    public string $search = '';

    public string $departemen = '';

    public string $status = '';

    public function mount(): void
    {
        $this->search = (string) request()->query('search', '');
        $this->departemen = (string) request()->query('departemen', '');
        $this->status = (string) request()->query('status', '');
    }

    public static function canAccess(): bool
    {
        /** @var User|null $user */
        $user = auth()->user();

        return $user?->can('manage-mahasiswa') ?? false;
    }

    protected function getViewData(): array
    {
        $mahasiswas = Mahasiswa::query()
            ->when(filled($this->search), function ($query) {
                $search = $this->search;

                return $query->where(function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nrp', 'like', "%{$search}%");
                });
            })
            ->when(filled($this->departemen), function ($query) {
                return $query->where('departemen', $this->departemen);
            })
            ->when($this->status !== '', function ($query) {
                return $query->where('is_active', $this->status === 'aktif');
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        /** @var Collection<int, string> $departemens */
        $departemens = Mahasiswa::query()
            ->distinct()
            ->orderBy('departemen')
            ->pluck('departemen');

        return [
            'mahasiswas' => $mahasiswas,
            'departemens' => $departemens,
        ];
    }
}
