<?php

namespace App\Filament\Resources\MasterData;

use App\Filament\Resources\MasterData\UnitConvertionResource\Pages;
use App\Filament\Resources\MasterData\UnitConvertionResource\RelationManagers;
use App\Models\UnitConvertion;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitConvertionResource extends Resource
{
    protected static ?string $model = UnitConvertion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_group')
                    ->relationship('convertionUnit', 'name')
                    ->preload()
                    ->createOptionModalHeading('Tambah Group Konversi Unit')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Nama Group')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->required(),
                Select::make('id_unit_from')
                    ->relationship('unit', 'name')
                    ->required(),
                TextInput::make('kali_utama')
                    ->required()
                    ->numeric(),
                Checkbox::make('is_main')
                    ->label('Satuan Utama?')
                    ->inline(false)
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListUnitConvertions::route('/'),
            'create' => Pages\CreateUnitConvertion::route('/create'),
            'edit' => Pages\EditUnitConvertion::route('/{record}/edit'),
        ];
    }
}
