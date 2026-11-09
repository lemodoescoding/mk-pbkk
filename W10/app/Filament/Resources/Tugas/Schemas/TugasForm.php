<?php

namespace App\Filament\Resources\Tugas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TugasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                TextInput::make('mata_kuliah')
                    ->label('Mata Kuliah')
                    ->required()
                    ->maxLength(255),
                Select::make('dosen_id')
                    ->label('Dosen Penanggung Jawab')
                    ->relationship('dosen', 'nama')
                    ->searchable()
                    ->preload(),
                DateTimePicker::make('deadline')
                    ->required(),
                Select::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'selesai' => 'Selesai',
                    ])
                    ->required()
                    ->default('aktif'),
            ]);
    }
}
