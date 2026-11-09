<?php

namespace App\Filament\Resources\Dosens\Schemas;

use App\Support\Departemen;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DosenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nip')
                    ->label('NIP')
                    ->required()
                    ->maxLength(30)
                    ->unique(ignoreRecord: true),
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Select::make('departemen')
                    ->options(array_combine(Departemen::OPTIONS, Departemen::OPTIONS))
                    ->required()
                    ->searchable(),
                Toggle::make('is_active')
                    ->label('Dosen Aktif')
                    ->default(true),
            ]);
    }
}
