<?php

namespace App\Filament\Resources\MasterData;

use App\Filament\Resources\MasterData\UnitConvertionGroupResource\Pages;
use App\Filament\Resources\MasterData\UnitConvertionGroupResource\RelationManagers;
use App\Models\UnitConvertionGroup;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitConvertionGroupResource extends Resource
{
    protected static ?string $model = UnitConvertionGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListUnitConvertionGroups::route('/'),
            'create' => Pages\CreateUnitConvertionGroup::route('/create'),
            'edit' => Pages\EditUnitConvertionGroup::route('/{record}/edit'),
        ];
    }
}
