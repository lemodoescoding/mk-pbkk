<?php

namespace App\Filament\Resources\Tugas;

use App\Filament\Resources\Tugas\Pages\CreateTugas;
use App\Filament\Resources\Tugas\Pages\EditTugas;
use App\Filament\Resources\Tugas\Pages\ListTugas;
use App\Filament\Resources\Tugas\Schemas\TugasForm;
use App\Filament\Resources\Tugas\Tables\TugasTable;
use App\Models\Tugas as TugasModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TugasResource extends Resource
{
    protected static ?string $model = TugasModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static string|\UnitEnum|null $navigationGroup = 'Data Akademik';

    protected static ?string $modelLabel = 'Tugas';

    protected static ?string $pluralModelLabel = 'Tugas';

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return TugasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TugasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTugas::route('/'),
            'create' => CreateTugas::route('/create'),
            'edit' => EditTugas::route('/{record}/edit'),
        ];
    }
}
