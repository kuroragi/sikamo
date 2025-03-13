<?php

namespace App\Filament\Resources\MasterData;

use App\Filament\Resources\MasterData\CostumerResource\Pages;
use App\Filament\Resources\MasterData\CostumerResource\RelationManagers;
use App\Models\Costumer;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CostumerResource extends Resource
{
    protected static ?string $model = Costumer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nik')
                    ->label('NIK')
                    ->numeric()
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Pelanggan')
                    ->required(),
                TextInput::make('phone')
                    ->label('No HP/WA')
                    ->prefix('+62')
                    ->numeric(),
                TextInput::make('email')
                    ->email(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK'),
                TextColumn::make('name')
                    ->label('Nama Pelanggan')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('No HP/WA'),
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
            'index' => Pages\ListCostumers::route('/'),
            'create' => Pages\CreateCostumer::route('/create'),
            'edit' => Pages\EditCostumer::route('/{record}/edit'),
        ];
    }
}
