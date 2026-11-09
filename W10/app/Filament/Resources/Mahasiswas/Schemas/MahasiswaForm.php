<?php

namespace App\Filament\Resources\Mahasiswas\Schemas;

use App\Support\Departemen;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MahasiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nrp')
                    ->label('NRP')
                    ->required()
                    ->maxLength(20)
                    ->unique(ignoreRecord: true),
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Select::make('departemen')
                    ->options(array_combine(Departemen::OPTIONS, Departemen::OPTIONS))
                    ->required()
                    ->searchable(),
                TextInput::make('angkatan')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue((int) date('Y')),
                Toggle::make('is_active')
                    ->label('Mahasiswa Aktif')
                    ->default(true),
            ]);
    }
}
